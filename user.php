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
				<button class="button" onclick="">
                                FOLLOW</button>
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
