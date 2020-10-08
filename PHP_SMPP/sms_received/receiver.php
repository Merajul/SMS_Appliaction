<?php
//for reading pending SMS you must frequently call this script. Use crontab job for example.

//print "<pre>";
require_once "smpp.php"; //SMPP protocol

//connect to the smpp server
$tx = new SMPP('172.0.0.1', 5003);
$tx->debug = true;

//bind the receiver
//$tx->system_type="WWW";
$tx->addr_npi = 1;
$tx->bindReceiver("systemid", "systempassword");

do {
	//read incoming sms  b  b
	$sms = $tx->readSMS();
	//check sms data
	if ($sms && !empty($sms['source_addr']) && !empty($sms['destination_addr']) && !empty($sms['short_message'])) {
		//send sms for processing in smsadv
		$from = $sms['source_addr'];
		$to = $sms['destination_addr'];
		$message = $sms['short_message'];
		//run some processing function for incomming sms
		process_message($from, $to, $message);
	}
//until we have sms in queue
} while ($sms);
//close the smpp connection
$tx->close();
unset($tx);
//clean any output

function process_message($from, $to, $message) {
	//$gsmencoder = new GsmEncoder;
	// $message = $gsmencoder->utf8_to_gsm0338($message);
	print "Received SMS\nFrom: $from\nTo:   $to\nMsg:  $message";
}
?>