<?php
//$surveyIP = "192.168.0.1";
//$pingresult = exec("ping -c 3 $surveyIP", $outcome, $status);
//if (0 == $status) {
//$status = "OK";
//} else {
//$status = "Unreachable";
//}
//echo "The IP address is ".$status;

if (@fsockopen("192.168.0.254", 8728, $errno, $errstr, 3)===false)
   echo 'Closed';
else
   echo 'Open';

?>
