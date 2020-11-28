<?php
	//$isStart = $_POST["ether"];
	if($isStart == true){$saveUP="starter";}
	else{$saveUP = null;}
	$saveEth = null;
	$saveWir = null;
	$saveTx = null;
	//get all data from MikroTik
	include('MTPaB_survey.php');
	if($saveEth == null)$saveEth = "no-link";
	if($saveUP == null)$saveUP = "no-conn";
	if($saveWir == null)$saveWir = 0;
	if($saveTx == null)$saveTx = 0;
	//save data to database table

	$connect=new mysqli("localhost","mt_user","Mikrotik#1","MT_db");
	if($connect->connect_error)
		$toSave = $connect->connect_error;
	else
		$toSave = "done";

	$sql = "INSERT INTO mikroData (uptime,etherStat,wirStat,txRate) VALUES ('$saveUP','$saveEth',$saveWir,$saveTx);";
	//echo $sql."<br>";
	if ($connect->query($sql) === TRUE) {
		$toSave .= " & updated!";
	} else {
		$toSave .= " update error!";/*$connect->error;*/
	}

	$connect->close();
	//return final string to app main
	$ret="ok"; if($saveWir == null)$ret="conn-error";
	echo json_encode("SQL: ".$toSave." MT: ".$ret);
?>
