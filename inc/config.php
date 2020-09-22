<?php

/*error(0): theres no error complete shrink √ */
/*error(1): api can not find http or https on url */
/*error(2): 404! api can not find the short url on the server */
/*error(3): add ?link=EX. or ?i=EX. to get result */

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "laganty";

function error($code){
		$list = [
							"000" => "Wrong endpoint or invalid API request.",
							"001" => "API service is disabled.",
							"002" => "A valid API key is required to use this service.",
							"003" => "You have been banned for abuse.",
							"004" => "Please enter a valid URL.",
							"005" => "This URL couldn't be found. Please double check it.",
							"006" => "This URL is private or password-protected.",
							"007" => "You must send an alias paramater with URLs alias as the value.",
							"008" => "This URL does not exist or is not associated with your account.",
							"009" => "You account is either not active or banned for abuse.",
							"010" => "The redirection type is invalid.",
							"011" => "You do not have the permission to use the API system. Contact administrator.",
					];
		if(!isset($list[$code])) $code = "002";
		return $this->build(["error" => 1, "msg" => $list[$code]]);
}
function rrnd() { 
$characters = 'aBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789'; 
$randomString = ''; 
$n=5;
for ($i = 0; $i < $n; $i++) { 
$index = rand(0, strlen($characters) - 1); 
$randomString .= $characters[$index]; 
} 
return $randomString; 
} 

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function ADD($t1,$t2,$t3){
$in = new mysqli($servername, $username, $password, $dbname);
if($in->connect_error){
	$res= $in->connect_error;
}else{
	$sql="INSERT INTO `short`(`url`, `apikey`, `byip`)
VALUES('$t1','$t2','$t3')";
if ($in->query($sql) === TRUE) {
	$res= True;
}else{
	$res= False;
}
}
$in->close();
return $res;
}



