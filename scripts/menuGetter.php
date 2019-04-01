<?php 
$content = file_get_contents('http://www.unica.fi/fi/ravintolat/galilei/');

preg_match_all('/(<td class=\"lunch\">(.*)<\/td>)|(data-dayofweek="(.*)<\/h4>)/',
                $content,
                $matches,
                PREG_UNMATCHED_AS_NULL
);

$matchesLength = count($matches[4]);
$dayCounter = 0;
$dishCounter = 1;
$day = substr($matches[4][0], 3);
$finalResult[0] = array($day); 

for($i = 1; $i < $matchesLength; $i++){
    if($matches[4][$i] != NULL){
        $dayCounter++;
        $dishCounter = 1;
        $day = substr($matches[4][$i], 3);
        $finalResult[$dayCounter] = array($day);
    }
    else{
        $finalResult[$dayCounter][$dishCounter] = $matches[2][$i];
        $dishCounter++;
    }
}

print_r($finalResult);
?>