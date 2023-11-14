<?php
include("../../config.php");

if(isset($_POST['username']) && isset($_POST['userLoggedIn'])) {
	$username1 = $_POST['userLoggedIn'];
    $username2 = $_POST['username'];
    
	$follow = mysqli_query($con, "delete from follows_user where u1='$username1' and u2='$username2';");
}

?>