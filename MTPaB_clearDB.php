<?php
		$server="localhost";
		$username="mt_user";
		$password="Mikrotik#1";
		$database ="MT_db";

		$connect=new mysqli($server,$username,$password,$database);
		if($connect->connect_error)
			echo "Connection error:" .$connect->connect_error;
		else
			echo "Connected<br>";

		$sql = "DELETE FROM mikroData;";

		if ($connect->query($sql) === TRUE) {
			echo "mikroData cleared!";
		} else {
			echo "Error: " . $sql . "<br>" . $connect->error;
		}

		$connect->close();
		header("Location: ./");
?>
