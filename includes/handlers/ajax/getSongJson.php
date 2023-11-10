<?php
include("../../config.php");

if(isset($_POST['songId'])) {
	$songId = $_POST['songId'];

	$query = mysqli_query($con, "SELECT * FROM song WHERE s_id='$songId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}


?>