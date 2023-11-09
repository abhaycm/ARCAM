<?php include("includes/header.php"); 

if(isset($_GET['id'])) {
	$releaseId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$releaseQuery = mysqli_query($con, "SELECT * FROM music_release WHERE r_id='$releaseId'");
$release = mysqli_fetch_array($releaseQuery);

$artist = new Artist($con, $release['a_id']);

echo $release['name'] . "<br>";
echo $artist->getName();

?>







<?php include("includes/footer.php"); ?>