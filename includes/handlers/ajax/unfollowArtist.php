<?php
include("../../config.php");

if(isset($_POST['artistid']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $artistid = $_POST['artistid'];

    $sql = "CALL UnfollowArtist('$username', $artistid)";
    $result = mysqli_query($con, $sql);
}

?>