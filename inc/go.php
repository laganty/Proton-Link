<html>
<head>
<script type="text/javascript">
            function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML) <= 0) {
				    document.getElementById("cz").innerHTML = "Now !";
                    location.href = '<?php echo str_replace("'", "",$url); ?>';
                }
                i.innerHTML = parseInt(i.innerHTML) - 1;
            }
            setInterval(function() {
                countdown();
            }, 1000);
        </script>
<?php
include('config.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$user_ip = getUserIP();
$go = $_GET['go'];
/* mySQL */

$sql = "SELECT `id`, `url`, `alias`, `byip` FROM `short` WHERE `alias`='$go'";
$result = $conn->query($sql);


/* END mySQL */

if ($result->num_rows > 0) {
	/* fetch */
	$row = $result->fetch_assoc();
	$to= $row["url"];
	/* end fetch to r0w */
	
//$fn = file_get_contents("short/".$go.".link");
if($go && !$conn->connect_error) {
header( "refresh:10;url=".$to );
header("charset=utf-8");
echo '
<title>redrict</title>
<style>
body{
background: #212121;
color: #27db31;
font-family: tajawal;
text-align: center ;
}
green{
color: #27db31;
}
red{
font-size: 24px;
color: #fa0000;
}
yellow{
color: #E7FF00;
}
blue{
font-size: 25px;
color: #0017FF;
}
bnf{
color: #FF00F2;
}
</style>
</head>
<body>
succes link | you well redrict <html><span id="cz"> in <bnf><span id="counter">10</span></bnf> second(s).</span><div> your ip: <a href="http://api.ipapi.com/'.$user_ip.'?access_key=5d46b1517ed5bf63813a860f8606e025&format=1">'.$user_ip.'</a></div></body></html>
';
}elseif($conn->connect_error){
	echo "error in db connect (_503_)";
}
}else{
	echo "error in db 2 fucked request (_404_)";
}
$conn->close();
?>
