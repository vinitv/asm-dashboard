<?php 

error_reporting(E_ALL);
ini_set('display_errors', 0);

function getChecks($id, $accountName){		

	$url="https://api-wpm.apicasystem.com/v3/checks/?auth_ticket=".$id;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result=curl_exec($ch);
	curl_close($ch);

//var_dump(json_decode($result, true));
$json_array = json_decode($result,true); // convert to object array
$output="<h2>".$accountName."</h2><table class='table table-bordered mychecks' width='100%''><thead><tr><th>ID</th><th>Name</th><th>Location</th><th><i class='fa fa-desktop' aria-hidden='true'></i></th><th>Details</th><th></th></tr></thead><tbody>";

foreach($json_array as $json){

	$statusColor="alert alert-success";
	if(strpos($json['severity'],'F')!==false){$statusColor="alert alert-danger";}
	if(strpos($json['severity'],'W')!==false){$statusColor="alert alert-warning";}
	if(strpos($json['severity'],'E')!==false){$statusColor="alert alert-error";}

	$checkTypename="<i title='".$json['check_type_name']."' data-toggle='tooltip'  class='fa fa-internet-explorer' aria-hidden='true'></i>";

	if(stripos($json['check_type_name'],'Explorer')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."' class='fa fa-internet-explorer' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'Firefox')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-firefox' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'Chrome')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-chrome' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'url')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-file-code-o' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'iphone')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa fa-mobile' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'Mobile')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-android' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'windows')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-windows' aria-hidden='true'></i>";}
	if(stripos($json['check_type_name'],'ipad')!==false){$checkTypename="<i data-toggle='tooltip' title='".$json['check_type_name']."'  class='fa fa-tablet' aria-hidden='true'></i>";}

	$checkSeverity="";

	if(stripos($json['severity'],'F')!==false){
		$checkSeverity="100";
	}elseif (stripos($json['severity'],'E')!==false) {
		$checkSeverity="50";
	}elseif (stripos($json['severity'],'W')!==false) {
		$checkSeverity="25";
	}else{$checkSeverity="0";}	

	$output.="<tr class='".$statusColor."'><td><a target='_blank' href='https://wpm.apicasystem.com/Check/Details/".$json['id']."'>".$json['id']."</a></td><td>".$json['name']."</td><td>".$json['location']."</td><td>".$checkTypename."</td><td>".$json['url']." | ".$json['check_type_name']." | ".$json['severity']."</td><td>".$checkSeverity."</td></tr>";
}

$output.="	</tbody></table>";

return $output;

}

$allChecks = $_POST['allChecks'];
$allChecks = preg_replace('/\s+/', '', $allChecks);
$result = array();
foreach (explode(',',$allChecks) as $sub){
	$subAry = explode(':',$sub);
	echo getChecks($subAry[0],$subAry[1]);
}




?>

