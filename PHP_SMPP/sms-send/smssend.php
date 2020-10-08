<?php
error_reporting(0);
include 'class.smpp.php';

$src = "16000"; // or text
$dst = "+880199999999";
$message = "Success MESSAGE";

$s = new smpp();
$s->debug = 0;

// $host,$port,$system_id,$password
$s->open("172.0.0.1", 5003, "systemid", "systempassword");

// $source_addr,$destintation_addr,$short_message,$utf=0,$flash=0
$s->send_long($src, $dst, $message);

/* To send unicode
$utf = true;
$message = iconv('Windows-1256','UTF-16BE',$message);
$s->send_long($src, $dst, $message, $utf);
 */

$s->close();
?>