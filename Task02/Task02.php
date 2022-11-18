<?php
const ENTRIES = 'entries';
const CATEGORY = 'Category';
const API = 'API';

$url = 'https://api.publicapis.org/entries';

$category = ucfirst($argv[1]);
$limit = $argv[2];

checkArgument($category, $limit);

$response = callApi($url);

printOutput($category, $limit, $response);


function callApi(String $url){
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

    return json_decode($response, true);
}

function checkArgument($category, $limit){
    if($category == null || $limit == null){
        exit('Missing arguments! please try again'. PHP_EOL);
    }
    elseif(!is_string($category) || is_numeric($category)){
        exit('Category value must be string. Please try again.'. PHP_EOL);
    }
    elseif(!is_numeric($limit) || !is_int($limit+0)){
        exit('Limit value must be an integer. Please try again.'. PHP_EOL);
    }
    return;
}

function printOutput($category, $limit, $response){
    $responseCategory = array_column($response[ENTRIES], CATEGORY);
    $responseCategoryValue = array_keys($responseCategory,$category);

    if(count($responseCategoryValue) > 0){

        if($limit < count($responseCategoryValue)){
            $responseCategoryValue = array_slice($responseCategoryValue,0,$limit);
        }

        $entries = array();
        for($i = 0; $i<count($responseCategoryValue); $i++){
            array_push($entries,$response[ENTRIES][$responseCategoryValue[$i]][API]);
        }

        rsort($entries);

        foreach($entries as $entry){
            echo $entry.PHP_EOL;
        }
    }else{
        echo 'No results'.PHP_EOL;
    }

    return;
}


