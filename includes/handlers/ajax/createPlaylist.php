<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date('Y-m-d');

    $query = mysqli_query($con,"insert into playlist(p_id,name,username,dateCreated) values('', '$name', '$username', '$date') ");

}
else {
    echo "name or username parameer not passed";
}

?>