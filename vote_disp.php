<?php
session_start();
include('inc/dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>
Candidate List
</title>
</head>
<body>
<div>
<?php
$district_id=0;
$sql1 = "SELECT state_id,district_id,pincode,ward_id from voter_details where aadhar_no='".$_SESSION['aadhar_no']."' and epic_number='".$_SESSION['epic']."'";
echo $sql1;
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) 
	{
		$state_id=$row1['state_id'];
		$district_id=$row1['district_id'];
		$pincode=$row1['pincode'];
		$ward_id=$row1['ward_id'];
	}
} else {
	echo "<b>Error While Fetching..</b>";
}		
$con_id=0;
$sql3= "SELECT con_id from constituency where con_district_id=$district_id";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
	while($row3 = $result3->fetch_assoc()) 
	{
		$con_id=$row3['con_id'];
	}
} else {
	echo "<b>Error While Fetching..</b>";
}	
$_SESSION['con_id']=$con_id;
$can_id=[];
$symbol_id=[];
$sql4= "SELECT can_id,symbol_id from candidate_details where con_id=$con_id";
$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {
	while($row4 = $result4->fetch_assoc()) 
	{
		$can_id[]=$row4['can_id'];
		$symbol_id[]=$row4['symbol_id'];
	}
} else {
	echo "<b>Error While Fetching..</b>";
}



for($i=0;$i<count($can_id);$i++)
{		
	echo "<form method=post action=vot_con.php name=".$can_id[$i].">
		<input type=hidden value=symbols/".$symbol_id[$i].".png name=add>
		<input type='hidden' name='can' id=".$can_id[$i]." value=".$can_id[$i].">
		<input type='image' src=symbols/".$symbol_id[$i].".png name='btn'>
		</form>";
}

?>
</div>
</body>
</html>