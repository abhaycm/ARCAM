<?php
include("../../config.php");

if(isset($_POST['releaseId'])) {
	$releaseId = $_POST['releaseId'];

	$query = mysqli_query($con, "SELECT * FROM music_release WHERE r_id='$releaseId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}


?>