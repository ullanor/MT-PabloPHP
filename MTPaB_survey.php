<?php
//$saveUP = "dupsko";
require_once('routeros_api.class.php');
$API = new RouterosAPI();
$API->debug = false;

if ($API->connect('192.168.0.254', 'admin', '')) {
//get ether name and status
   $API->write('/interface/ethernet/print');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $toE = $OUT[0]['name'];
   $API->write('/interface/ethernet/monitor',false);
   $API->write("=numbers=$toE",false);
   $API->write('=once=');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $saveEth = $OUT[0]['rate'];
//---------------------------------------------------------------
//get wir name, status and txRates
   $API->write('/interface/wireless/print');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $toW = $OUT[0]['name'];
   $API->write('/interface/wireless/monitor',false);
   $API->write("=numbers=$toW",false);
   $API->write('=once=');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $saveWir = intval($OUT[0]['signal-strength']); $saveTx = intval(substr($OUT[0]['tx-rate'],0,-4));
//---------------------------------------------------------------
//check if first
   if($saveUP == null){
//---------------------------------------------------------------
//get uptime
   $API->write('/system/resource/print');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $saveUP = $OUT[0]['uptime'];}
//---------------------------------------------------------------
//get serial
   else{
   $API->write('/system/routerboard/print');
   $READ = $API->read(false);
   $OUT = $API->parseResponse($READ); $saveUP = $OUT[0]['serial-number'];

   include('MTPaB_checkClear.php');}
//---------------------------------------------------------------
   $API->disconnect();
}
//echo "out ".$saveUP." ".$saveEth." ".$saveWir." ".$saveTx." end";
?>
