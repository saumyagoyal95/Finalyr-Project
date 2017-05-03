<?php

//Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "reg3(03+14)";
$dbname = "urls";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Get the URL
$url = $_POST['urlis'];

/*if($url.find("?")<10000 && $url.find("/")<10000){
       $sub = $url.find("?", 0) - $url.find("/", 0);
       $mystr1 = $url.substr($url.find("/", 0)+1, $sub-1);
}
else if($url.find("/")<10000 && $url.find("?")>10000){
       $mystr1 = $url.substr($url.find("/", 0)+1, strlen($url)-1);
}
else{
	$mystr1 = $url;
}*/
//Start of functions
//
//
//
//Length of Host Name L(HN)
$countd = 0;
$countl = 0;
for($i=1; $i<=strlen($url); $i++){
	$dot = $url[$i];
	if($dot == '.'){
		$countd++;
	}
	else if($countd == 1){
		$countl++;
	}
	else if($countd == 2){
		break;
	}
}	
$lhn = $countl;

//Length of URL L(URL)
$lurl = strlen($url);

//Period Count N(DIN)	
$countp=0;
for($i=1; $i<strlen($url);$i++){
	$period = $url[$i];
	if($period == '.')
	{
		$countp++;
	}
}
$ndin = $countp;

//Domain Count N(DT)
$count = 0;
for($i=0; $i<strlen($url); $i++){
	$c = $url[$i];
	if($c=='/'){
		$ndt = $count-1;
		break;
	}
	else if ($c=='.'){
		$count++;
	}
	else if ($i==strlen($url)-1) {
		$ndt = $count-1;
	}
}

//Path Count N(PT)
$count_slash=0;
for($i=1; $i<strlen($url); $i++){
	$cc = $url[$i];
	if ($i==strlen($url)-1){
		$npt = $count_slash;
		break;
	}
	else if ($cc=='/'){
		$count_slash++;
	}
}

//Path Attribute Count N(PAT)
$count_att=0;
for($i=1; $i<strlen($url); $i++){
	$ch = $url[$i];
	if ($i==strlen($url)){
		$npat = $count_att;
		break;
	}
	else if ($ch=='='){
		$count_att++;
	}
}
$npat = $count_att;


//Avg Length of Domain Token A(DTC)
$sum=0;
$high=0;
$arr = explode("/", $url);
$first = $arr[0];
$arr1 = explode(".", $first);
for ($i=1; $i<=count($arr1)-2; $i++) { 
	$str1[$i] = strlen($arr1[$i]);
}
for ($j=1; $j<=count($arr1)-2; $j++) { 
	if($high<$str1[$j]){
		$high = $str1[$j];
	}
	$sum += $str1[$j];
}
$adtc = ($sum)/(count($arr1)-2);

//Longest Length of Domain Token LL(DT)
$lldt = $high;

//Avg Length of Path Token A(PTC)
$sum1=0;
$high1=0;
$url2 = strstr($url, '/');
if(count($arr)<2){
	$aptc = 0;
}
$out = preg_split("#[?=&/]#", $url2);
for ($i=0; $i<count($out); $i++) { 
	$str2[$i] = strlen($out[$i]);
}
for ($j=0; $j<count($out); $j++) { 
	if($high1<$str2[$j]){
		$high1 = $str2[$j];
	}
	$sum1 += $str2[$j];
}
$aptc = ($sum1)/(count($out));

//Longest Length of Path Token LL(PT)
$llpt = $high1;


//Final Score Calculation
$w1 = 1;
$w2 = 1;
$w3 = 1;
$w4 = 1;
$w5 = 1;
$w6 = 1;
$w7 = 1;
$w8 = 1;
$w9 = 1;
$w10 = 1;

$twt = $w1+$w2+$w3+$w4+$w5+$w6+$w7+$w8+$w9+$w10;
$rp = (($lhn*$w1)+($lurl*$w2)+($ndin*$w3)+($ndt*$w4)+($npt*$w5)+($npat*$w6)+($adtc*$w7)+($lldt*$w8)+($aptc*$w9)+($llpt*$w10))/($twt);

//Driving SQL Queries
$sql = "INSERT INTO maindata (URL, LHN, LURL, NDIN, NDT, NPT, NPAT, ADTC, LLDT, APTC, LLPT, RP)
VALUES ('$url', '$lhn', '$lurl', '$ndin', '$ndt', '$npt', '$npat', '$adtc', '$lldt', '$aptc', '$llpt', '$rp');";
$sql.= "CREATE TABLE maindata1 LIKE maindata;";
$sql.= "INSERT INTO maindata1 (URL, LHN, LURL, NDIN, NDT, NPT, NPAT, ADTC, LLDT, APTC, LLPT, RP) SELECT URL, LHN, LURL, NDIN, NDT, NPT, NPAT, ADTC, LLDT, APTC, LLPT, RP FROM maindata ORDER BY RP ASC;";
$sql.= "DROP TABLE maindata;";
$sql.= "RENAME TABLE maindata1 TO maindata;";
$sql.= "SELECT `Rank` FROM `maindata` WHERE `URL`='$url';";

// Execute multi query
if (mysqli_multi_query($conn,$sql))
{
  do
    {
    // Store first result set
    if ($result=mysqli_store_result($conn)) {
      // Fetch one and one row
      while ($row=mysqli_fetch_row($result))
        {
        //printf("Rank:%s\n",$row[0]);
        $_SESSION["rk"] = $row[0];
        $_SESSION["urlname"] = $url;
        header('Location: result.php');
        exit;	
        }
      // Free result set
      mysqli_free_result($result);
      }
    if (!mysqli_more_results($conn)) {
    	exit();
	}
}
  while (mysqli_next_result($conn));
}

$conn->close();

?>