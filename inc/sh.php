<?php

include('config.php');
$method = $_SERVER['REQUEST_METHOD'];
/*if ($method == 'POST'){
    $url = $_POST['link'];
	$cus = $_POST['cus'];
} else {*/
    $url = $_GET['link'];
	$cus = $_GET['cus'];
//}
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=utf-8");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$allo_chart = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[.\!\/\\\\w]*))?)/i';
$verify = preg_match($url_reg);

$spam = array("s", "g", "htaccess", "short", "api", "su", "bot", "laganty");

$user_ip = getUserIP();
$rrnd = rrnd();
  
if(!$conn->connect_error){
if (!preg_match('/^([Hh]ttp|[Hh]ttps)(.*)/',$url)) {
    $error = json_encode(['ok'=>false,'error'=>5,'msg'=>this_site_not_soported,'by'=>Laganty], 128 | 256);
    echo $error;
} else {
$short='http://'.$_SERVER['SERVER_NAME'].'/'.$rrnd;
/* mySL start */
$sql="INSERT INTO `short`(`url`, `apikey`, `byip`)
VALUES('$url','$rrnd','$user_ip')";
if ($conn->query($sql) === TRUE){
/* mySQL end */
header("content-type: application/json; charset=utf-8");
echo json_encode(['ok'=>true,'error'=>0,'msg'=>complete_short,'long'=>$url,'short'=>$short,'id'=>$rrnd,'user_ip'=>$user_ip,'by'=>Laganty], 128 | 256);
}else{ echo json_encode(['ok'=>false,'error'=>3,'msg'=>db_2_error_cannot_add_alias,'by'=>Laganty], 128 | 256); }
}
}else{ echo "error connect to db"; }

/*if(!$url && !$cus){
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=utf-8");
echo json_encode(['ok'=>false,'error'=>3,'msg'=>add_method,'by'=>Laganty], 128 | 256);
}*/

$conn->close();

