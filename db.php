<?php
	
	session_start();
    $server='sql306.epizy.com';
    $username='epiz_27375844';
    $password='PVT4dmP93mnygL';
    $db='epiz_27375844_practice';
	$con=mysqli_connect($server,$username,$password,$db);
	
	$_SESSION['connection']=$con;
	if(!$con){
		echo" connection unsuccessful";
	}
?>


