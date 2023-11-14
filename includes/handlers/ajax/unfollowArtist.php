<?php
include("../../config.php");

if(isset($_POST['artistid']) && isset($_POST['userLoggedIn'])) {
	$username1 = $_POST['userLoggedIn'];
    $artistid = $_POST['artistid'];

    $u1 = mysqli_query($con,"select * from user where username = '$username1' ");
    $u2 = mysqli_query($con,"select * from artist where a_id = '$artistid' ");
    $u1_id = mysqli_fetch_array($u1);
    $u2_id = mysqli_fetch_array($u2);

    $id1 = $u1_id['u_id'];
    $id2 = $u2_id['a_id'];
    
	$follow = mysqli_query($con, "delete from follows_artist where u_id='$id1' and a_id='$id2';");
}

?>