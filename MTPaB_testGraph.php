<?php
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
        $TEMP_ARRAY = array("y" => abs($row["wirStat"]),
	"label" => $row["uptime"]);
	array_push($MAIN_ARRAY, $TEMP_ARRAY);
	}
	}
	else
	echo "No matched data!";

	$connect->close();
?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
    	title: {
    		text: "MT wireless signal over time"
    	},
    	axisY: {
    		title: "Wireless signal absolute",
		//minimum: -70,
		//maximum: -50,
    	},
    	data: [{
    		type: "spline",
    		dataPoints: <?php echo json_encode($MAIN_ARRAY, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();

    }
    </script>
</head>
<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
