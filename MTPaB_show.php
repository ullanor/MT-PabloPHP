<?php
	$save = $_GET['save'];
	$addi = $_GET['addi'];
	$MAIN_ARRAY = array();

	$server="localhost";
	$username="mt_user";
	$password="Mikrotik#1";
	$database = "MT_db";

	$connect=new mysqli($server,$username,$password,$database);
	if($connect->connect_error)
		echo "Connection error:" .$connect->connect_error;
	else
		echo "";

	$result = $connect->query("select * from mikroData;");

	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()){
        $TEMP_ARRAY = array("uptime" => $row["uptime"],
	"etherStat" => $row["etherStat"],
	"wirStat" => $row["wirStat"],
	"txRate" => $row["txRate"],
	"txCCQ" => $row["txCCQ"],
	"locTime" => $row["locTime"]);
	array_push($MAIN_ARRAY, $TEMP_ARRAY);
	}
	}
	else
	echo "No matched data!";

	$connect->close();
	//start showing data in table ...
	if($save == 1){ ob_start(); echo "SAVED: ";}//start saving the buffer
	echo $MAIN_ARRAY[0][uptime]."<br>";
	if($save == 1){echo "Add-Info: ".$addi;}
	//table preparations
	$TableRows = ceil(count($MAIN_ARRAY)/10);
?>

<html>
<head>
    <title>MT-Pablo data</title>
    <style>
        .red   {background-color: #F00;}
	.whiteyellow {background-color: #90a312;}
        .yellow  {background-color: #ebd113;}
        .white {background-color: #2eb80f;}
    </style>
</head>
<body>
<h id="tx" style="color:#e60000;">error info</h><br>
<h id="sig" style="color:#336600;">error info 2</h><br><br>
    <?php
$txRB = 0;
$sigRB =0;
	function checkValues($temp,&$txRB,&$sigRB){
        	$marker = 0;
		global $MAIN_ARRAY;
		if($MAIN_ARRAY[$temp][wirStat] < -65)$marker = 1;
		if($MAIN_ARRAY[$temp][txRate] < 54)$marker = 2;
		if($MAIN_ARRAY[$temp][txCCQ] < 50)$marker = 2;
		if($MAIN_ARRAY[$temp][wirStat] < -75)$marker = 3;
		if($MAIN_ARRAY[$temp][txRate] < 48)$marker = 3;
		if($MAIN_ARRAY[$temp][etherStat] != "100Mbps")$marker = 3;

		$mix = $MAIN_ARRAY[$temp][etherStat]."<br>".
		"sig: ".$MAIN_ARRAY[$temp][wirStat]."<br>tx: ".$MAIN_ARRAY[$temp][txRate]."<br>".
		"ccq: ".$MAIN_ARRAY[$temp][txCCQ]."<br>".$MAIN_ARRAY[$temp][uptime]."<br>". 
		"t: ".$MAIN_ARRAY[$temp][locTime]."<br>";

		if($marker == 0)echo "<td class='white'>".$mix."</td>";
		elseif($marker == 1){echo "<td class='whiteyellow'>".$mix."</td>"; $sigRB++;}
		elseif($marker == 2)echo "<td class='yellow'>".$mix."</td>";
		else echo "<td class='red'>".$mix."</td>";
		if($marker > 1){$txRB++;}
	}
        echo "<table border = '1' style='width: 100%;table-layout: fixed;'>";
        echo "<tr><td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>";
	for ($i = 0; $i < $TableRows; $i++) {
    		echo "<tr>";
		echo "<td>".($i*10)."</td>";
		for ($j = 0; $j < 10; $j++){
			$temp = $i*10+$j;
			checkValues($temp,$txRB,$sigRB);
		}
		echo "</tr>";
	}
        echo "</table>";

echo "<script>document.getElementById('sig').innerHTML = 'Signals that are over border value: $sigRB';</script>";
echo "<script>document.getElementById('tx').innerHTML = 'TxRate that get below border value: $txRB';</script>";

$s = "SAVED/".$MAIN_ARRAY[0][uptime].".html";
if($save == 1){date_default_timezone_set('Europe/Warsaw'); echo "Saved: ".date("Y-m-d h:i:sa"); 
file_put_contents($s,ob_get_contents());
header("Location: ./");
}
?>
</body>
</html>
