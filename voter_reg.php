<?php
include('index.php');
include('inc/dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>

<title>Voter Registeration</title>
</head>

<body>
<form action="#" method="post">
<table width="533" >
  <tr>
    <th width="189" scope="row">EPIC</th>
    <td width="328">
        <input type="text" name="epic" />
    </td>
  </tr>
  <tr>
    <th scope="row">VOTER NAME  </th>
    <td>
        <input type="text" name="voter" />
    </td>
  </tr>
  <tr>
    <th scope="row">FATHER NAME </th>
    <td><input type="text" name="father" /></td>
  </tr>
  <tr>
    <th scope="row">STATE</th>
    <td><select name="state">
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
    </select>
    </td>
  </tr>
  <tr>
    <th scope="row">PINCODE</th>
    <td><input type="text" name="pin" /></td>
  </tr>
  <tr>
    <th scope="row">DISTRICT</th>
    <td><select name=city>
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
	</select></td>
  </tr>
  <tr>
    <th scope="row">WARD</th>
    <td><select name="ward">
	<?php
	for($i=1;$i<20;$i++)
	{
		echo "<option value=$i>$i ward</option>";
	}
	?>
    </select>
    </td>
  </tr>
  <tr>
    <th scope="row">ADDRESS</th>
    <td><textarea name="add"></textarea></td>
  </tr>
  <tr>
    <th scope="row">AADHAR</th>
    <td><input type="text" name="aadhar" /></td>
  </tr>
</table>
<input type="submit" value="Add" name="btn">
</form>
</body>
</html>
<?php
if(isset($_POST['btn']))
{
	$epic=$_POST['epic'];
	$name=$_POST['voter'];
	$father=$_POST['father'];
	$state=$_POST['state'];
	$pin=$_POST['pin'];
	$city=$_POST['city'];
	$ward=$_POST['ward'];
	$add=$_POST['add'];
	$aadhar=$_POST['aadhar'];
	
	$sql="INSERT INTO voter_details (epic_number, voter_name, fathers_name, state_id, district_id, pincode, ward_id, address, aadhar_no, status) VALUES ('$epic', '$name', '$father',$state,$city ,$pin, $ward, '$add', $aadhar, '0')";
	if ($conn->query($sql) === TRUE) {
		echo "Record Added successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}	
	

	
}


?>