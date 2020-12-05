<?php
      		include 'db.php';
$message='';
if(isset($_POST['transfer'])){
  $fromid=$_POST['from'];
$toid=$_POST['opt'];
$amount=$_POST['transfermoney'];
$currentbalance=$_POST['currentbalance'];
if($amount>0 && $currentbalance>$amount){
$query1="insert into transfers(fromid,toid,amount)values('$fromid','$toid','$amount')";
$execute=mysqli_query($_SESSION['connection'],$query1);
$query2="update customer set currentBalance=currentBalance+'$amount' where userid='$toid'";
$execute1=mysqli_query($_SESSION['connection'],$query2);
$query3="update customer set currentBalance=currentBalance-'$amount' where userid='$fromid'";
$execute2=mysqli_query($_SESSION['connection'],$query3);
$message="Recent Transaction:".$amount." "."transferred"."<br>"."From Account No:".$fromid." to"." ".$toid."<br>Credited".$amount."to account no".$toid."<br>Refresh Page to remove this message";
}
else{
    $message="Transaction Failed:Either You have entered negative amount or you have entered the amount greater than your currentbalance";
}
}
// if(isset($_SESSION['message'])){
//   echo $_SESSION['message'];
//   unset($_SESSION['message']);
//   session_unset();
// }
         
?>
<!DOCTYPE html>
<html>
<head>
	<title>View All Customers</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="icon" href="https://www.thesparksfoundationsingapore.org/images/logo_small.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
function removemessage(){
var message=document.getElementById('message');
message.style.display="none";
}
</script>
<style>
body{
background:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-ylWpeEXuqekT0uoDPZI4Hb3WShrV78TSzw&usqp=CAU');
background-size:cover;
background-repeat:no-repeat;

}
.blinking{
    animation:blinkingText 2s infinite;
}
@keyframes blinkingText{
    0%{     color:white;opacity:1; }
    
    50%{    opacity:0.4;  }
    100%{   color:white; opacity:1;   }
}
  </style>
   <script>
   		let from=0;
     
   		$(document).ready(function(){
   			ajaxfetch();
        
   		});
   		function ajaxfetch(){
   			$.ajax({
   				url:"fetchcustomers.php",
   				success:function(data){
   					$(".fetchuserfromajax").html(data);
   				}
   			});	
   		}
   		function passvalue(x){
        from=x;
       
   			$('#exampleModal').modal('show');
        $.ajax({
            url:"fetchusernames.php",
            type:"post",
            data:{var1:x},
            success:function(data){
              $('#fetch').html(data);
            }
        });
   		}
   </script>
</head>
<body>
 
	
<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top:10%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Select Customer to transfer money</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="fetch" style="font-size:2rem">
      		  please wait...
      	</div>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="container" style="padding-top:3rem;min-height:100vh">
 <div style="text-align:center">
  <img src="https://www.thesparksfoundationsingapore.org/images/logo_small.png" height="200" width="200">
</div>
<div style="text-align:center;color:white">
	<h2>TSF(The Sparks Foundation) Basic Bank System</h2>
	<h2>Fetched The Information From Our Bank Database</h2>
	<h3>Live Updation OF amounts</h3>
</div>
<?php
    if($message!=""){
          echo  '<div class="card" id="message" style="display:block;background:black;font-size:2.1rem;color:white;border-radius:18px;"><div class="card-text blinking" style="color:white;text-align:center;">'.$message.'</div><br><button class="btn btn-success" onclick="removemessage()" style="margin-left:40%">Remove message</button></div>';
    }
?>
  
<table class="table table-bordered table-stripped text-dark" style="background:#f2fefc;width:80%;margin-top:3rem;text-align:center;font-size:2.3rem">
  <thead>
    <tr style="background:black;color:white">
      
      <th scope="col">Username/Email<br>current_balance</th>
      <th scope="col">Transfer_Money</th>
    </tr>
  </thead>
  <tbody class="fetchuserfromajax">
  	<!--fetching the data from MYSQL(DATABASE) with the help of php-->	
  </tbody>
</table>
</div>

</body>

</html>
