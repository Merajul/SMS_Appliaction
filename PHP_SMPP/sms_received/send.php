<?php

require_once "smpp.php";

$tx = new SMPP('172.0.0.1', 5003); // make sure the port is integer
$tx->debug = false;

$tx->bindTransmitter("systemid", "systempassword");
$tx->addr_npi = 1;
$result = $tx->sendSMS("16000", "01966666666", "Hellow");
echo $result;
echo $tx->getStatusMessage($result);
$tx->close();
unset($tx);

//require_once "smpp.php";
//$tx=new SMPP('172.16.249.43',5003);
//$tx->debug=true;
//$tx->system_type="WWW";
//$tx->addr_npi=1;
//print "open status: ".$tx->state."n";
//$tx->bindTransmitter("gyanvandar","gy@nv1nr");
//$tx->sms_source_addr_npi=1;
//$tx->sms_source_addr_ton=1;
//$tx->sms_dest_addr_ton=1;
//$tx->sms_dest_addr_npi=1;
//$tx->sendSMS("16678","+8801939502207","Hello world!");
//$tx->close();
//unset($tx);
//print "</pre>";

//print "<pre>";
//require_once "smpp_transceiver.php";
//$tx=new SMPP('172.16.249.43',5003);
//$tx->debug=true;
//$tx->system_type="WWW";
//$tx->addr_npi=1;
//print "open status: ".$tx->state."\n";
//$tx->bindTransmitter("gyanvandar","gy@nv1nr");
//$tx->sms_source_addr_npi=1;
//$tx->sms_source_addr_ton=1;
//$tx->sms_dest_addr_ton=1;
//$tx->sms_dest_addr_npi=1;
//$tx->sendSMS("16678","+8801939502207","world");

//$tx->close();
//unset($tx);
//print "</pre>";
?>


