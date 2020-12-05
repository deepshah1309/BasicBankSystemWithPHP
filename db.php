<?php
	
	session_start();
//hiding  password for security purpose
    $server='sql306.epizy.com';
    $username='epiz_27375844';
    $password='';
    $db='epiz_27375844_practice';
	$con=mysqli_connect($server,$username,$password,$db);
	
	$_SESSION['connection']=$con;
	if(!$con){
		echo" connection unsuccessful";
	}
?>


