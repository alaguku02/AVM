<?php
session_start();
include('inc/dbconn.php');
?>
<!Doctype html>
<html>
<head>
<title>
Verify AADHAR
</title>
</head>
<body>
<form method="post" action="#">
<label>Enter AADHAR Number</label>
<input type="text" name="aadhar">
<input type="submit" name="verify" value="check">
</form>

</body>
</html>
<?php
if(isset($_POST['verify']))
{
	$aadhar=$_POST['aadhar'];
	if(chk_stat($aadhar)==1)
	{
		echo "<b>Already Voted</b>";
	}
	else
	{
		include('inc/dbconn.php');
		$sql = "SELECT aadhar_no,epic_number from voter_details where aadhar_no='$aadhar'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) 
			{
				$tmp1=$row['aadhar_no'];
				$tmp2=$row['epic_number'];
				$tmp3=mt_rand(0,100);
				$sql1 = "INSERT INTO voter_authentication(aadhar_no,finger_det,epic) VALUES('$tmp1',".$tmp3.",'$tmp2')";
				$result1 = $conn->query($sql1);
				echo "<b>Identity: ".$tmp3."</b>";

			}
		} 
			else {
			echo "<b>Connection Error</b>";
		}

	}
	

}
function chk_stat($epic)
{
	include('inc/dbconn.php');
	$sql = "SELECT status from voter_details where aadhar_no='$epic'";
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