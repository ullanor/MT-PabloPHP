<?php
	$isStart = $_POST["ether"];
	if($isStart == 66){$saveUP="starter";}

	//get all data from MikroTik
	include('MTPaB_survey.php');
	if($saveEth == null)$saveEth = "no-link";
	//save data to database table

	$connect=new mysqli("localhost","mt_user","Mikrotik#1","MT_db");
	if($connect->connect_error)
		$toSave = $connect->connect_error;
	else
		$toSave = "done";

	$sql = "INSERT INTO mikroData (uptime,etherStat,wirStat,txRate) VALUES ('$saveUP','$saveEth',$saveWir,$saveTx);";
	//echo $sql."<br>";
	if ($connect->query($sql) === TRUE) {
		$toSave .= "Entry updated!";
	} else {
		$toSave .= $connect->error;
	}

	$connect->close();
	//return final string to app main
	echo json_encode($toSave." parame: ".$number);
?>
