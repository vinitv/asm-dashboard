<?php 

error_reporting(E_ALL);
ini_set('display_errors', 0);

function getChecks($allChecks1,$allChecks2,$cnt){		

	$result1=curlMystuff($allChecks1);
	$result2=curlMystuff($allChecks2);

	
	$json_array1 = json_decode($result1,true);
	$json_array2 = json_decode($result2,true); // convert to object array

	$myarray = array();


	foreach($json_array1 as $key => $value ){
		
		
		$myarray[] = array('A' => $json_array1[$key]['value'],'B' => $json_array2[$key]['value']);       
		
	}

	return $myarray;

}

function flipUrlcount($url,$count){

	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	$oldCount=$query['mostrecent'];
	$newUrl=str_replace("mostrecent=".$oldCount,"mostrecent=".$count,$url);

	return $newUrl;
}


function curlMystuff($url){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result=curl_exec($ch);
	curl_close($ch);

	return $result;

}



$allChecks1 = $_POST['allChecks1'];

$allChecks2 = $_POST['allChecks2'];
$allCount = $_POST['allCount'];

$allChecks1=flipUrlcount($allChecks1,$allCount);
$allChecks2=flipUrlcount($allChecks2,$allCount);

$allChecks1 = preg_replace('/\s+/', '', $allChecks1);
$allChecks2 = preg_replace('/\s+/', '', $allChecks2);

echo json_encode(getChecks($allChecks1,$allChecks2,48));


?>

