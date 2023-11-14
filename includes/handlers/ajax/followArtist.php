<?php
include("../../config.php");

if(isset($_POST['username']) && isset($_POST['userLoggedIn'])) {
	$username1 = $_POST['userLoggedIn'];
    $username2 = $_POST['username'];

    $u1 = new User($con,$username1);
    $u2 = new User($con,$username2);
    $u1_id = u1->getId();
    $u2_id = u2->getId();
    
	$follow = mysqli_query($con, "INSERT INTO follows_user VALUES ($u1_id,$u2_id);");
}

?>