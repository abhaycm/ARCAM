<?php
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$username = $_GET['id'];
}
else {
	header("Location: index.php");
}

$user = new User($con, $username);
?>

<head>

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

</head>

<div class="entityInfo" class="borderBottom" style=" border-bottom :1px solid #939393;
    margin-bottom: 20px;">
    
	<div class="centerSection">

		<div id="artistInfo" style="text-align:center">

			<h1 class="artistName"><?php echo $user->getName(); ?></h1>

			<div class="headerButtons">
				<!-- <button class="button" onclick="">FOLLOW</button> -->
				<?php
					$username1 = $userLoggedIn->getUsername();
					$username2 = $username;

					$u1 = mysqli_query($con,"select * from user where username = '$username1' ");
					$u2 = mysqli_query($con,"select * from user where username = '$username2' ");
					$u1_id = mysqli_fetch_array($u1);
					$u2_id = mysqli_fetch_array($u2);

					$id1 = $u1_id['u_id'];
					$id2 = $u2_id['u_id'];

					if($id1 != $id2){
						$query = mysqli_query($con, "select * from follows_user where u1 = '$id1' and u2 = '$id2' ");

						if(mysqli_num_rows($query) == 0){
							echo "<button class='button' onclick='followUser(\"" . $username2 . "\")'>FOLLOW</button>";
						}
						else {
							echo "<button class='button green unfollowButton' onclick='unfollowUser(\"" . $username2 . "\")'>FOLLOWING</button>";
						}
					}
					
					
				?>

			</div>

		</div>

	</div>

</div>

<div class="gridViewContainer">
	<h2 style="text-align:center;">PLAYLISTS</h2>
	<?php
		$playlistQuery = mysqli_query($con, "SELECT p_id,playlist.name as pname FROM playlist,user WHERE user.username='$username' AND playlist.username=user.username");

		while($row = mysqli_fetch_array($playlistQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $row['p_id'] . "\")'>
						<img src='assets/images/icons/playlist.png'>

						<div class='gridViewInfo'>"
							. $row['pname'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>
