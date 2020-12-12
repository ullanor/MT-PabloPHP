<?php
$type = $_GET["typer"];

if($type == 4){
$f = fopen("MikroTestStop.txt", "w");
fwrite($f,"5");
fclose($f);
}
else if($type == 5){
$f = fopen("MikroTestFinished.txt", "w");
fwrite($f,"safe mode operation");
fclose($f);
}
else{
$f = fopen("MikroTestStart.txt", "w");
fwrite($f,"2000");
fclose($f);
}
header("Location: ./");
?>
