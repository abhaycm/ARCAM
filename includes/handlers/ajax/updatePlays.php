<?php
include("../../config.php");

if(isset($_POST['songId'])) {
	$songId = $_POST['songId'];

	$query = mysqli_query($con, "update song set number_of_plays = number_of_plays + 1 WHERE s_id='$songId'");
}
?>