<?php

$conn = [
    'mysql' => [
        'mysql:host=localhost;dbname=testing',
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
