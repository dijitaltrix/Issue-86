<?php
include('bootstrap.php');

// fetch repository
$repo = new Test\Repository();
// fetch data faker
$faker = Faker\Factory::create();


// create a parent to many children items oneToMany relationship 
for ($d=0; $d<5; $d++)
{
    $data = [
        'customer_id' => rand(1,20),
        'date' => $faker->dateTimeThisYear()->format('Y-m-d'),
        'reference' => $faker->randomNumber(5),
        'items' => [],
    ];
    for ($i=0; $i<rand(3,6); $i++) {
        $data['children'][] = [
            'description' => $faker->sentence,
            'quantity' => rand(1,9),
            'price' => $faker->randomFloat(2, 10, 100),
        ];
    }
    
    print_r($data);

    $domain = $repo->create($data);

}