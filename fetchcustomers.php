<?php
include 'db.php';
$query="select *from customer";
$execute=mysqli_query($_SESSION['connection'],$query);
  		while(($row=mysqli_fetch_array($execute))!=NULL){
  			echo '<tr><td>Account_no:'.$row['userid'].'<br>'.$row['username'].'/'.$row['emailid'].'<br>Balance:'.$row['currentBalance'].'</td><td><button class="btn btn-success" style="font-size:2rem" onclick=passvalue('.$row['userid'].') id="'.$row['userid'].'">Transfer</button></td></tr>';
  		}

?>