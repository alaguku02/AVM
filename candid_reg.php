<?php
include('index.php');
include('inc/dbconn.php');
?>
<html>
<body>
<form method="post" action="#">
<label>Candidate Name</label></br>
<input type=text name=cand_name ><br>
<label>Candidate Name-Native Language</label></br>
<input type=text name=cand_name_local ><br>
<label>Constituency</label></br>
<select name="cons">
<?php
$sql = "SELECT con_id,con_name FROM constituency";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=".$row['con_id'].">".$row['con_name']."</option>";
    }
} else {
    echo "0 results";
}
?>
</select>
<input type="submit" value="Add" name="btn"/>
</form>
</body>
</html>
<?php
if(isset($_POST['btn']))
{
	$can_name=$_POST['cand_name'];
	$can_local_name=$_POST['cand_name_local'];
	$cons=$_POST['cons'];
	$sql="INSERT INTO candidate__per_details (can_id, can_name, can_name_local_lang) VALUES (NULL, '$can_name', '$can_local_name')";
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}		
	$can_id=0;
	
	$sql = "SELECT can_id FROM candidate__per_details where can_name='$can_name' and can_name_local_lang='$can_local_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $can_id=$row['can_id'];
    }
} else {
    echo "0 results";
}
	
	
	
	
	
	
	
	
	
	
	
	$sql = "INSERT INTO candidate_details (con_id, can_id, symbol_id) VALUES ($cons, $can_id, $can_id)";
	
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}		
}
?>
