<?php
include 'class.smpp.php';

$src  = "16678"; // or text 
$dst  = "01939502207";
$message = "Test Message";

$s = new smpp();
$s->debug=1;

// $host,$port,$system_id,$password
$s->open("172.16.249.43", 5003, "gyanvandar", "gy@nv1nr");

// $source_addr,$destintation_addr,$short_message,$utf=0,$flash=0
$s->send_long($src, $dst, $message);

/* To send unicode 
$utf = true;
$message = iconv('Windows-1256','UTF-16BE',$message);
$s->send_long($src, $dst, $message, $utf);
*/

$s->close();
?>