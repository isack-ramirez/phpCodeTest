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


$j = count($areaValue1);

$html = '
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<div class="grid-container">

  <div class="grid-item" id="grid-item1"><h6>Unit number</h6></div>
  <div class="grid-item"id="grid-item2" ><h6>Floor ID </h6></div>
  <div class="grid-item" id="grid-item3"><h6>Last updated</h6></div>  
</div>

<div class="grid-container">

  <div class="grid-item" id="grid-item4"><h6>Unit number</h6></div>
  <div class="grid-item"id="grid-item5" ><h6>Floor ID </h6></div>
  <div class="grid-item" id="grid-item6"><h6>Last updated</h6></div>  
</div>


</body>
</html>';

$doc = new DOMDocument(); 
$doc->loadHTML($html);



for($i=0;$i<$j;$i++){
    $test = $areaValue1[$i]->unit_number;
    $descBox = $doc->getElementById('grid-item1');
    $appended = $doc->createElement('li', $test);

  
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item1');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);

    $test = $areaValue1[$i]->floor_id;
    $descBox = $doc->getElementById('grid-item2');
    $appended = $doc->createElement('li', $test);
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item2');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);

    

    $test =  $areaValue1[$i]->updated_at;
  

    $time = strtotime($test);

    $fixed = date(' F jS Y \a\t g:ia', $time);

    $descBox = $doc->getElementById('grid-item3');
    $appended = $doc->createElement('li', $fixed);
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item3');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);
 
}

$j = count($areaValueGreaterThanOne);

for($i=0;$i<$j;$i++){
 
    $test = $areaValueGreaterThanOne[$i]->unit_number;
    $descBox = $doc->getElementById('grid-item4');
    $appended = $doc->createElement('li', $test);
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item4');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);


    $test = $areaValueGreaterThanOne[$i]->floor_id;
    $descBox = $doc->getElementById('grid-item5');
    $appended = $doc->createElement('li', $test);
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item5');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);

    $test =  $areaValueGreaterThanOne[$i]->updated_at;
  

    $time = strtotime($test);

    $fixed = date(' F jS Y \a\t g:ia', $time);

    $descBox = $doc->getElementById('grid-item6');
    $appended = $doc->createElement('li', $fixed);
    $descBox->appendChild($appended);

    $descBox = $doc->getElementById('grid-item6');
    $appended = $doc->createElement('hr', $test);

  
    $descBox->appendChild($appended);
}


echo $doc->saveHTML();


?>
