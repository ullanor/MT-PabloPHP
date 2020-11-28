<?php
$server="localhost";
                $username="mt_user";
                $password="Mikrotik#1";
                $database ="MT_db";

                $connect=new mysqli($server,$username,$password,$database);
                if($connect->connect_error){}

                $sql1 = "SELECT COUNT(*) as total FROM mikroData;";
                $result = $connect->query($sql1);

                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                $TEMP =  $row["total"];}}

                $connect->close();

echo json_encode($TEMP);
?>
