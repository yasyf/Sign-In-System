<?php
$user = $_REQUEST['user'];
$date = $_REQUEST['date'];
$month = $_REQUEST['month'];
$hour = $_REQUEST['hour'];
if(!is_dir("img/$user/$month/$date"))
{
	mkdir ("img/$user/$month/$date",0777,true);
}

$str = file_get_contents("php://input");
file_put_contents("img/$user/$month/$date/".$hour.".jpg", pack("H*", $str));

?>