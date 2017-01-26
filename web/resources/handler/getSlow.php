<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 0);


	//echo getSlowest($resultId,$apiKey,$checkId);

	$allChecks = $_POST['allChecks'];
	$apiKey = $_POST['myKey'];
	$allChecks = preg_replace('/\s+/', '', $allChecks);
	$apiKey = preg_replace('/\s+/', '', $apiKey);
	$result = array();

	$output="<table class='table table-bordered mychecks' width='100%''><thead><tr><th>Check ID</th><th>URL</th><th>Response Time</th><th>Status Code</th></tr></thead><tbody>";

	foreach (explode(',',$allChecks) as $sub){
		$output.= getSlowest($apiKey,$sub);
	}
	$output.="	</tbody></table>";

echo $output;


	function getResultId($apiKey,$checkId){

	$url="https://api-wpm.apicasystem.com/v3/checks/".$checkId."/results?auth_ticket=".$apiKey."&mostrecent=1&detail_level=1";

	$result=json_decode(curlMyStuff($url),true);


	return $result[0]['identifier'];

	}

	function curlMyStuff($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;
	}


	function getSlowest($apiKey,$checkId){		

	$resultId=getResultId($apiKey,$checkId);
	$url="https://api-wpm.apicasystem.com/v3/checks/browser/".$checkId."/results/".$resultId."/urldata?format=json&auth_ticket=".$apiKey."&mostrecent=1&detail_level=1";
	$result=curlMyStuff($url);

	$json_array = json_decode($result,true); // convert to object array
	
	$output="";
	$myarray = array();

	{
	foreach($json_array as $json){
	foreach($json[0]['url_results'] as $js){	

	$myarray[] = array("url" => $js['url'], "response_time_ms" => $js['response_time_ms'], "http_status_code" => $js['http_status_code']);


	}	} }

	$myarray=array_sort($myarray, 'response_time_ms', SORT_DESC);
	$ct=0;
	foreach($myarray as $j){	if($ct<1){
	$output.="<tr class=''><td><a target='_blank' href='https://wpm.apicasystem.com/Check/Details/".$checkId."'>".$checkId."</a></td><td><a href='".$j['url']."'>".substr($j['url'],0,150)."</a></td><td>".$j['response_time_ms']."</td><td>".$j['http_status_code']."</td></tr>";
	$ct++;
	}
	}
		

		return $output;

	}



	function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}

?>

