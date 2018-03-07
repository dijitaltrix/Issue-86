<?php

$conn = [
    'mysql' => [
        'mysql:host=localhost;dbname=testing',
        'test',
        'test'
    ],
    'mysql_vbox' => [
        'mysql:host=10.0.1.7;dbname=testing',
        'test',
        'test'
    ],
    'sqlite' => [
        'sqlite:db/test.sqlite',
        null,
        null,
    ]
];

return $conn['mysql'];
