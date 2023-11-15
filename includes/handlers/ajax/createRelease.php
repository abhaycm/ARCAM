<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['type']) && isset($_POST['genre']) && isset($_POST['cover_art']) && isset($_POST['number_of_tracks'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $type = $_POST['type'];
    $genre = $_POST['genre'];
    $cover_art = $_POST['cover_art'];
    $number_of_tracks = $_POST['number_of_tracks'];

    $user = mysqli_query($con, "select * from user where username='$username' ");
    $user_row = mysqli_fetch_array($user);
    $u_id = $user_row['u_id'];

    $artist = mysqli_query($con, "select * from artist where u_id='$u_id' ");
    $artist_row = mysqli_fetch_array($artist);
    $a_id = $artist_row['a_id'];

    $query = mysqli_query($con,"insert into music_release(name,type,a_id,genre,cover_art) values('$name', '$type', '$a_id', '$genre', '$cover_art') ");

}

?>
{ name: release_name, type: type, genre: genre,cover_art: cover_art, number_of_tracks: nuber_of_tracks }