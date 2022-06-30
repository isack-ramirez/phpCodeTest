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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


<div class="buttonContainer">
<a href="#list1"><button>Jump to list 1</button></a>
<a href="#list2"><button>Jump to list 2</button></a>
</div>

<div class="grid-container"id="list1">

  <div class="grid-item" id="grid-item1"><h6>Unit number</h6></div>
  <div class="grid-item"id="grid-item2" ><h6>Area</h6></div>
  <div class="grid-item" id="grid-item3"><h6>Last updated</h6></div>  
</div>

<div class="grid-container"id="list2">

  <div class="grid-item" id="grid-item4"><h6>Unit number</h6></div>
  <div class="grid-item"id="grid-item5" ><h6>Area</h6></div>
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

    $test = $areaValue1[$i]->area;
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


    $test = $areaValueGreaterThanOne[$i]->area;
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
