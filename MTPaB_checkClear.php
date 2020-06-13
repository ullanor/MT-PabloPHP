<?php
		$server="localhost";
		$username="mt_user";
		$password="Mikrotik#1";
		$database ="MT_db";

		$connect=new mysqli($server,$username,$password,$database);
		if($connect->connect_error){}

		//todo checking and deleting
		$sql2 = "DELETE FROM mikroData;";
		$sql3 = "ALTER TABLE mikroData AUTO_INCREMENT = 1;";
		$sql1 = "select * from mikroData where id=1;";

		$result = $connect->query($sql1);

		if ($result->num_rows > 0) {
        	while($row = $result->fetch_assoc()){
        	$TEMP =  $row["uptime"];}}
        	//else $errork =  "No matched data!";

		if($saveUP != $TEMP){
		if($connect->query($sql2) == TRUE){}/*else{$errork .= $connect->error;}*/

                if($connect->query($sql3) == TRUE){}/*else{$errork .= $connect->error;}*/
		}

		$connect->close();
?>
