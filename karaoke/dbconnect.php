<?php	
	if (!session_id()) session_start();
	$username="root";
	$password="";
	$db="karaoke";
	$con= mysql_connect("localhost",$username,$password) or die("Không thể kết nối CSDL!");
	mysql_select_db($db,$con) or die ('Không thể kết nối CSDL!'.$db);
	mysql_query("SET NAMES 'utf8'");
	
?>