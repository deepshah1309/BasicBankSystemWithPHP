<?php
include 'db.php';
$fromid=$_POST['from'];
$toid=$_POST['opt'];
$amount=$_POST['transfermoney'];
$query1="insert into transfers(fromid,toid,amount)values('$fromid','$toid','$amount')";
$execute=mysqli_query($_SESSION['connection'],$query1);
$query2="update customer set currentBalance=currentBalance+'$amount' where userid='$toid'";
$execute1=mysqli_query($_SESSION['connection'],$query2);
$query3="update customer set currentBalance=currentBalance-'$amount' where userid='$fromid'";
$execute2=mysqli_query($_SESSION['connection'],$query3);
$_SESSION['message']=$amount." "."transferred";
header('Location:viewAllcustomers.php');

?>

