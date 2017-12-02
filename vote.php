<?php
session_start();
include('inc/dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div id="">
<form method="post" action="#">
<label>Enter The Unique Number</label>
<input type="text" name="uniq"/></br>
<input type="submit" name="btnSubmit"/>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['btnSubmit']))
{
	$uniq=$_POST['uniq'];
	$aadhar_no="";
	$epic="";
	$state_id="";
	$district_id="";
	$state_id="";
	$pincode="";
	$ward_id="";
	$sql = "SELECT epic,aadhar_no from voter_authentication where finger_det=$uniq";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
		{
			$aadhar_no=$row['aadhar_no'];
			$epic=$row['epic'];
			$_SESSION['aadhar_no']=$aadhar_no;
			$_SESSION['epic']=$epic;
			
		}
	} else {
		echo "<b>could not verify you..</b>";
	}
	if(chk_stat($epic)==1)
	{
		echo "<b>You are already Voted..</b>";
		session_destroy();
	}
	else		
	{
		header('location:vote_disp.php');
	}

}
function chk_stat($epic)
{
	include('inc/dbconn.php');
	$sql = "SELECT status from voter_details where epic_number='$epic'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
		{
			$tmp=$row['status'];
			if($tmp==1)
			{return 1;}
			else				
			{return 0;}

		}
	} else {
		echo "<b>Connection Error</b>";
	}
}
?>