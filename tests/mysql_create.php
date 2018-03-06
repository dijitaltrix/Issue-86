<?php
include('bootstrap.php');

use Atlas\Orm\AtlasContainer;
use Test\Parent\ParentMapper;
use Test\Child\ChildMapper;


$data =[
    'customer_id' => 101,
    'date' => time(),
    'reference' => 'abcde',
    'children' => [
        [
            'parent_id' => null,
            'description' => 'Test child item',
            'price' => 10.99,
            'quantity' => 2
        ],
        [
            'parent_id' => null,
            'description' => 'Another item',
            'price' => 14.99,
            'quantity' => 1
        ],
    ],
];

$con = new AtlasContainer(new \PDO(
    'mysql:host=localhost;dbname=testing',
    'test',
    'test'
));

$con->setMappers([
    ParentMapper::class,
    ChildMapper::class,
]);

$atlas = $con->getAtlas();

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

$result = $transaction->exec();

if ($result) {

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