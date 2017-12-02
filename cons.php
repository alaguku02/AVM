<?php
include('index.php');
include('inc/dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Constituency Reg</title>
</head>
<body>
<div class="w3-card-4" style="width:400px; height:200px;">

<div class="w3-container w3-green">
  <h2>Constituency Enroll</h2>
</div>

<form class="w3-container" method="post" action="#">

<label>Constituency Name</label>
<input class="w3-input" type="text" name="city">
<label>City Name</label>
<select name="state">
<?php
$sql = "SELECT dist_id,dist_name FROM district";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=".$row['dist_id'].">".$row['dist_name']."</option>";
    }
} else {
    echo "0 results";
}
?>
</select></br>

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

	$sql = "INSERT INTO constituency (con_id, con_name, con_district_id) VALUES (NULL, '$city', '$state')";
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}	
}
?>