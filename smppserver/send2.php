<?php

require_once "smpp.php";
$tx=new SMPP('172.0.0.1',5003); // make sure the port is integer
$tx->debug=false;
$tx->bindTransmitter("system_id","system_pass");
$result = $tx->sendSMS("16000","01900000","Thank you");
echo $tx->getStatusMessage($result);
$tx->close();
unset($tx);

?>