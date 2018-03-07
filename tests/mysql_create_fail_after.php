<?php
include('bootstrap.php');

use Atlas\Orm\AtlasContainer;
use Test\Parent\ParentMapper;
use Test\Child\ChildMapper;

$datas = [
    [
        'customer_id' => 101,
        'date' => date('Y-m-d'),
        'reference' => 'abcdef',
        'children' => [
            [
                'parent_id' => null,
                'description' => 'A child item',
                'price' => 10.99,
                'quantity' => 1
            ],
            [
                'parent_id' => null,
                'description' => 'Another child item',
                'price' => 14.99,
                'quantity' => 1
            ],
        ],
    ],
    [
        'customer_id' => 202,
        'date' => date('Y-m-d'),
        'reference' => 'xyz123',
        'children' => [
            [
                'parent_id' => null,
                'description' => 'A child item',
                'price' => 9.99,
                'quantity' => 2
            ],
            [
                'parent_id' => null,
                'description' => 'Another child item',
                'price' => 19.99,
                'quantity' => 2
            ],
            [
                'parent_id' => null,
                'description' => 'A futher child item',
                'price' => 2.99,
                'quantity' => 2
            ],
        ],
    ],
    [
        'customer_id' => 303,
        'date' => date('Y-m-d'),
        'reference' => 'abc123',
        'children' => [
            [
                'parent_id' => null,
                'description' => 'A child item',
                'price' => 4.99,
                'quantity' => 99 // this will throw an Exception in src/Child/ChildMapperEvents.php 
                                 // the parent 'reference:abc123' should not be created
            ],
            [
                'parent_id' => null,
                'description' => 'Another child item',
                'price' => 19.99,
                'quantity' => 3
            ],
        ],
    ],
];

$con = new AtlasContainer(new \PDO(
    'mysql:host=localhost;dbname=testing',
    'test',
    'test'
));

// $con = new AtlasContainer(new \PDO(
//     'mysql:host=10.0.1.7;dbname=testing',
//     'test',
//     'test'
// ));

$con->setMappers([
    ParentMapper::class,
    ChildMapper::class,
]);

$atlas = $con->getAtlas();

foreach ($datas as $data)
{
    // begin transaction
    $transaction = $atlas->newTransaction();

    // create parent from data, stripping out related child ['children'] from $data
    $parent = $atlas->newRecord(ParentMapper::class, array_diff_key($data, ['children'=>0]));

    // create parent items as record set
    $parent->children = $atlas->newRecordSet(ChildMapper::class);

    // append item children from $data['children'] to $parent->children
    foreach ($data['children'] as $child) {
        $parent->children[] = $atlas->newRecord(ChildMapper::class, $child);
    }

    // store parent and items
    $transaction->persist($parent);

    if ($transaction->exec()) {

        echo "\nCreated record $parent->id ok\n";

    } else {

        // get the exception that was thrown in the transaction
        $e = $transaction->getException();

        // get the work element that threw the exception
        $work = $transaction->getFailure();

        // some output
        echo "The Transaction failed:\n";
        echo $work->getLabel() . ' threw exception ' . $e->getMessage();
    
    }
}

$rs = $atlas
    ->select(ParentMapper::CLASS)
    ->orderBy(['id'])
    ->fetchRecords();

print_r($rs);