<?php
include('index.php');
include('inc/dbconn.php');

$can_id=[];
$sql = "SELECT can_id from candidate_details";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
		$can_id[]=$row['can_id'];
    }
} else {
    echo "0 results";
}

foreach($can_id as $can)
{
$sql = "SELECT * from vote_table where can_id=$can";
$result = $conn->query($sql);
$count=0;
$con_id=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $count=$count+1;
		$con_id=$row['con_id'];
    }
} else {
    echo "0 results";
}
echo "</br><table><Tr><td>Candidate List</td><td>Vote</td></tr><Tr><td>$con_id</td><td>$count</td></tr></table>";
}
?>


