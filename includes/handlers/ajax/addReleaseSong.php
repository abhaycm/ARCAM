<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['path']) && isset($_POST['duration']) && isset($_POST['release_order'])) {
    $name = $_POST['name'];
    $path = $_POST['path'];
    $duration = $_POST['duration'];
    $release_order = $_POST['release_order'];

    $release_query = mysqli_query($con, "select * from music_release order by r_id desc limit 1");
    $release_array = mysqli_fetch_array($release_query);
    $r_id = $release_array['r_id'];
    $a_id = $release_array['a_id'];

    $query = mysqli_query($con,"insert into song(name,a_id,r_id,duration,actual_song,release_order) values('$name' , '$a_id' , '$r_id' , '$duration' , '$path' , '$release_order' ) ");

}

?>