<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 0);

	function getChecks($allChecks1,$allChecks2,$cnt){		

	$result1=curlMystuff($allChecks1);
	$result2=curlMystuff($allChecks2);

	
	$json_array1 = json_decode($result1,true);
	$json_array2 = json_decode($result2,true); // convert to object array
//var_dump($result);
	$myarray = array();
	/*
	foreach($json_array as $json){

		$myarray[] = array($json['check_id'] => $json['value']);
		
	}*/


	foreach($json_array1 as $key => $value ){
  
        

              //  $myarray[] = array($json_array1[$key]['check_id'] => $json_array1[$key]['value'],$json_array2[$key]['check_id'] => $json_array2[$key]['value']);
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
	



	//echo getChecks("https://api-wpm.apicasystem.com/v3/Checks/120509/results?mostrecent=20&detail_level=0&auth_ticket=31381A2A-9480-4023-AE96-189589CE4409");


?>

