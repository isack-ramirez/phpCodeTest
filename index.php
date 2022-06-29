<?php


$ch = curl_init();

$options = array(
    CURLOPT_URL => 'https://api.sightmap.com/v1/assets/1273/multifamily/units',
    CURLOPT_RETURNTRANSFER =>1,
    CURLOPT_SSL_VERIFYHOST =>false,
    CURLOPT_SSL_VERIFYPEER=>false,
    CURLOPT_HTTPHEADER => array(
        "API-Key: 7d64ca3869544c469c3e7a586921ba37"
    )
);

curl_setopt_array($ch,$options);

$response = curl_exec($ch);

if($response===false){
    echo curl_error($ch);
}

curl_close($ch);


$formattedRes = json_decode($response);


$extractedData = $formattedRes->data;

print_r($extractedData);

$areaValue1=array();
$areaValueGreaterThanOne=array();





echo "hello world";