<?php

$category = ucfirst($argv[1]);
$limit = $argv[2];

return;

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

$response = json_decode($response, true);


$responseCategory = array_column($response['entries'],'Category');
$responseCategoryValue = array_keys($responseCategory,$category);

if(count($responseCategoryValue) > 0){

    if($limit < count($responseCategoryValue)){
        $responseCategoryValue = array_slice($responseCategoryValue,0,$limit);
    }

    $entries = array();
    for($i = 0; $i<count($responseCategoryValue); $i++){
        array_push($entries,$response['entries'][$responseCategoryValue[$i]]['API']);
    }

    rsort($entries);

    foreach($entries as $entry){
        echo $entry.PHP_EOL;
    }
}else{
    echo 'No results'.PHP_EOL;
}


