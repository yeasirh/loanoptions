<?php

$category = $argv[1];
$limit = $argv[2];

var_dump($category, $limit);
die();
$url = 'https://api.publicapis.org/entries';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
'X-RapidAPI-Host: kvstore.p.rapidapi.com',
'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
'Content-Type: application/json'
]);
$response = curl_exec($curl);

if(!$response){
    die("connection failure");
}

curl_close($curl);

echo $response . PHP_EOL;

