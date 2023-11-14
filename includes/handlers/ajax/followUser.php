<?php
include("../../config.php");

if(isset($_POST['username']) && isset($_POST['userLoggedIn'])) {
	$username1 = $_POST['userLoggedIn'];
    $username2 = $_POST['username'];

    $u1 = mysqli_query($con,"select * from user where username = '$username1' ");
    $u2 = mysqli_query($con,"select * from user where username = '$username2' ");
    $u1_id = mysqli_fetch_array($u1);
    $u2_id = mysqli_fetch_array($u2);

    $id1 = $u1_id['u_id'];
    $id2 = $u2_id['u_id'];
    
	$follow = mysqli_query($con, "INSERT INTO follows_user VALUES ('$id1', '$id2');");
}

?>