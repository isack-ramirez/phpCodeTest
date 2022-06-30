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
<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto;

  padding: 0px;
  max-width : 50vw;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);

  font-size: 30px;
  text-align: center;
}

li {
    list-style-type: none;
    font-size: small;
    padding: 5px;
   }
</style>
</head>
<body>



<div class="grid-container">

  <div class="grid-item" id="grid-item1"><h6>Unit number</h6></div>
  <div class="grid-item"id="grid-item2" ><h6>Floor ID </h6></div>
  <div class="grid-item" id="grid-item3"><h6>Last updated</h6></div>  
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
echo $doc->saveHTML();


?>
