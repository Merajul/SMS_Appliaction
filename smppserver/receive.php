<?php
//for reading pending SMS you must frequently call this script. Use crontab job for example.
//ob_start();
//print "<pre>";
require_once "smpp.php";//SMPP protocol
require_once "send.php";
//connect to the smpp server
$tx=new SMPP('172.0.0.1',5003);
$tx->debug=true;

//bind the receiver
//$tx->system_type="WWW";
$tx->addr_npi=1;
$tx->bindReceiver("systemid","systempass");

do{
	//read incoming sms
	$sms=$tx->readSMS();
	//check sms data
	if($sms && !empty($sms['source_addr']) && !empty($sms['destination_addr']) && !empty($sms['short_message'])){
		//send sms for processing in smsadv
		$from=$sms['source_addr'];
		$to=$sms['destination_addr'];
		$message=$sms['short_message'];
	    //run some processing function for incomming sms
	    process_message($from,$to,$message);
		sendFeedback($from);
	}
//until we have sms in queue
}while($sms);
//close the smpp connection
$tx->close();
unset($tx);
//clean any output
//ob_end_clean();

function sendFeedback($from){
	  
	$src  = "16000"; // or text 
	$dst  = $from;
	$message = "Thank You";

	$s = new smppsend();
	$s->debug=1;

	// $host,$port,$system_id,$password
	$s->open("172.0.0.1", 5003, "systemid", "systempass");

	// $source_addr,$destintation_addr,$short_message,$utf=0,$flash=0
	$s->send_long($src, $dst, $message);

	/* To send unicode 
	$utf = true;
	$message = iconv('Windows-1256','UTF-16BE',$message);
	$s->send_long($src, $dst, $message, $utf);
	*/

	$s->close();
}


function process_message($from,$to,$message){
	print "Received SMS\nFrom: $from\nTo:   $to\nMsg:  $message";
}
?>