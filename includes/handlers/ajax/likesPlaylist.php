<?php
include("../../config.php");

if(isset($_POST['playlist_id']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $p_id = $_POST['playlist_id']; 

    $user = mysqli_query($con,"select * from user where username = '$username' ");
    $user_info = mysqli_fetch_array($user);
    $u_id = $user_info['u_id'];

    
	$like = mysqli_query($con, "INSERT INTO likes_playlist VALUES ('$u_id', '$p_id');");
}

?>