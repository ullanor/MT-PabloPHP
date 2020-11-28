<?php
if (isset($argc)) {
for ($i = 0; $i < $argc; $i++) {
    if($i == 1)$surveyCount = $argv[$i];
    if($i == 2)$surveyIP = $argv[$i];
    echo "Argument #" . $i . " - " . $argv[$i] . "\n";
     }
}
else {
    echo "argc and argv disabled\n";
}
//--------------------------------------
if(!isset($surveyCount))$surveyCount = 2000;
if(!isset($surveyIP))$surveyIP = "192.168.0.1";
//--------- test mikro ip --------------
//exec("ping -c 3 $surveyIP",$output, $status);

//echo $status;

//if (@fsockopen("192.168.0.1", 443)===false)
//   echo 'host is down\n';
//else
//   echo 'host is up\n';
//--------------------------------------
//echo "count: ".$surveyCount."\r\n";

$isStart = true;
echo "testing has started!\n";
include("MTPaB_main.php");
$isStart = false;
for ($i = 1; $i <= $surveyCount-1; $i++) {
    sleep(3);
    if(file_exists ("/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestStop.txt"))break;
    echo "\n".$i." iteration in progress! ".$surveyIP."\r\n";
    include("MTPaB_main.php");
}

//finish testing
echo "\ntesting has finished!\n";
$f = fopen("/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestFinished.txt", "w");
fwrite($f,"2000");
fclose($f);

?>

