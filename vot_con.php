<?php
//VoteConfirmation
session_start();
include('inc/dbconn.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Confirmation</title>
</head>
<body>
<form method="post" action="#">
<table>

<?php
$add=$_POST['add'];
$can_name="";
$can_local_name=$_POST['can'];
$sql5= "SELECT can_name, can_name_local_lang from candidate__per_details where can_id=$can_local_name";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) {
	while($row5 = $result5->fetch_assoc()) 
	{ echo "<tr>
			<td rowspan=2>
			<img src=$add width=50 height=50>
			</td>
				<td>".$row5['can_name']."</td>				
			</tr><tr><td>".$row5['can_name_local_lang']."</td></tr>";
	}
} else {
	echo "<b>Error While Fetching..</b>";
}				
		
?>
</table>
<input type="hidden" name="con" value=<?php echo $_SESSION['con_id'] ?>>
<input type="hidden" name="can" value=<?php echo $_POST['can']?>>
<input type="submit" name="chg" value="Chnge"><input type="submit" value="Vote it" name='btn'>
</form>
</body>
</html>

<?php
if(isset($_POST['btn']))
{
	$can1=$_POST['can'];
	$con1=$_POST['con'];
	$epic=$_SESSION['epic'];
	// sql to delete a record
	$sql = "INSERT INTO vote_table (vo_id, can_id, con_id) VALUES (NULL, $can1, $con1)";
	if ($conn->query($sql) === TRUE) {
    echo "You voted successfully";
	$sql1 = "UPDATE voter_details SET status=1 WHERE epic_number='$epic'";
	if ($conn->query($sql1) === TRUE){}    
	session_destroy();
	header('location:vote.php');
} else {
    echo "Error in voting: " . $conn->error;
}
}
if(isset($_POST['chg']))
{
	header('location:vote_disp.php');
}

?>
