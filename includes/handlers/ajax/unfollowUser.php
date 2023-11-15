<?php
include("../../config.php");

if(isset($_POST['username']) && isset($_POST['userLoggedIn'])) {
	$username1 = $_POST['userLoggedIn'];
    $username2 = $_POST['username'];

    $sql = "CALL UnfollowUser('$username1', '$username2')";
    $result = mysqli_query($con, $sql);
}

?>