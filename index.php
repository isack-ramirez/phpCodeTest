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



$areaValue1=array();
$areaValueGreaterThanOne=array();

$j =count( $extractedData);
for($i=0; $i<$j;$i++){
   
    if($extractedData[$i]->area ==1){
        array_push($areaValue1, $extractedData[$i]);
    }
    else{
        array_push($areaValueGreaterThanOne, $extractedData[$i]);
    }

}
print_r($areaValueGreaterThanOne);


echo "hello world";