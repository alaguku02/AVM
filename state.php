<?php
include('index.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>State Reg</title>
</head>
<body>
<div class="w3-card-4" style="width:400px; height:200px;">

<div class="w3-container w3-green">
  <h2>State Enroll</h2>
</div>

<form class="w3-container" method="post" action="#">

<label>State Name</label>
<input class="w3-input" type="text" name="state">
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
	$sql = "INSERT INTO state_details (state_id, state_name) VALUES (NULL, '$state')";
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}	
}
?>