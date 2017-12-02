<?php
include('index.php');
include('inc/dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>District Reg</title>
</head>
<body>
<div class="w3-card-4" style="width:400px; height:200px;">

<div class="w3-container w3-green">
  <h2>District Enroll</h2>
</div>

<form class="w3-container" method="post" action="#">

<label>City Name</label>
<input class="w3-input" type="text" name="city">
<label>State Name</label>
<select name="state">
<?php
$sql = "SELECT state_id,state_name FROM state_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=".$row['state_id'].">".$row['state_name']."</option>";
    }
} else {
    echo "0 results";
}
?>
</select></br>
<label>PINCODE</label>
<input class="w3-input" type="text" name="pin">

<input class="w3-button w3-red w3-hover-blue" type="submit" name="add" value="Add to.">

</form>

</div>
</body>
</html>
<?php

if(isset($_POST['add']))
{
	include('inc/dbconn.php');
	$state=$_POST['state'];
	$city=$_POST['city'];
	$pincode=$_POST['pin'];
	$sql = "INSERT INTO district (dist_id, state_id, dist_name, dist_pincode) VALUES (NULL, $state, '$city', $pincode)";
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}	
}
?>