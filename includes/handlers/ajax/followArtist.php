<?php
include("../../config.php");

if(isset($_POST['artistid']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $artistid = $_POST['artistid'];

    // Call the stored procedure
    $sql = "CALL FollowArtist('$username', $artistid)";
    $result = mysqli_query($con, $sql);
}


?>