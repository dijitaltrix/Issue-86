<?php

namespace Test;

use Exception;
use Atlas\Orm\AtlasContainer;
use Test\Parent\ParentMapper;
use Test\Child\ChildMapper;


class Repository {
    
    private $atlas;
    
    
    public function __construct()
    {
        // TODO grab these vars from config passed to __construct
        $con = new AtlasContainer(new \PDO(
            'mysql:host=localhost;dbname=testing',
            'test',
            'test'
        ));
        $con->setMappers([
            ParentMapper::class,
            ChildMapper::class,
        ]);

        $this->atlas = $con->getAtlas();
        
    }
    
    
    /**
     * Persist a new parent with related items from the $data array
     *
     * @param array $data
     * @return void
     */
    public function create(Array $data=[])
    {
        // create parent from data, stripping out related child ['children'] from $data
        $parent = $this->atlas->newRecord(ParentMapper::class, array_diff_key($data, ['children'=>0]));

        // create parent items as record set
        $parent->children = $this->atlas->newRecordSet(ChildMapper::class);
    
        // append item children from $data['children'] to $parent->children
        foreach ($data['children'] as $item_data) {
            $parent->children[] = $this->atlas->newRecord(ChildMapper::class, $item_data);
        }

        // begin transaction
        $transaction = $this->atlas->newTransaction();

        // store parent and items
        $transaction->persist($parent);
        
        // would prefer try catch here!
        if ($transaction->exec()) {
            
            echo "OK";
        
        } else {

            // get the exception that was thrown in the transaction
            $e = $transaction->getException();

            // get the work element that threw the exception
            $work = $transaction->getFailure();

            // some output
            echo "The Transaction failed: ";
            echo $work->getLabel() . ' threw ' . $e->getMessage();
            
        }
        
    }

 
}