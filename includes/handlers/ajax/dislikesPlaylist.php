<?php
include("../../config.php");

if(isset($_POST['playlist_id']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $p_id = $_POST['playlist_id'];
    
    $user = mysqli_query($con,"select * from user where username = '$username' ");
    $user_info = mysqli_fetch_array($user);
    $u_id = $user_info['u_id'];

    
	$dislike = mysqli_query($con, "delete from likes_playlist where u_id = '$u_id' and p_id = '$p_id' ;");
}

?>