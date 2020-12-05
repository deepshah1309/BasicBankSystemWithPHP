<?php
	include 'db.php';
	$userid=$_POST['var1'];
		$query1="select *from customer where userid !='$userid'";
			$execute1=mysqli_query($_SESSION['connection'],$query1);
			$query2="select *from customer where userid='$userid'";
			$execute2=mysqli_query($_SESSION['connection'],$query2);
			$getarray=mysqli_fetch_array($execute2);
			echo '<h3>Transfer Money From&nbsp'.$getarray['username'].'/Email='.$getarray['emailid'].'<br>current balance ='.$getarray['currentBalance'].'&nbspTo</h3>';
			echo '<form method="POST" id="forms" action="viewAllCustomers.php">';
            echo '<input type="hidden" name="currentbalance" value="'.$getarray['currentBalance'].'"/>';
			echo '<input type="hidden" name="from" value="'.$userid.'"/>';
  		while(($row=mysqli_fetch_array($execute1))!=NULL){
  			
  				echo '<div class="radio">
			  <label><input type="radio" name="opt" value="'.$row['userid'].'" required>'.$row['username'].'</label>
			</div>';
				
		}
			echo '<label><b>Enter Amount to be transferred Below</b></label><br><input type="number" placeholder="Enter Amount" name="transfermoney" style="width:200px" id="amount" required/><br>';
			echo '<input type="submit" value="transfer" name="transfer" class="btn btn-success" style="font-size:2rem"/></form>';
?>
