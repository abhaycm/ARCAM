<?php include("includes/header.php"); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

	<?php
		$releaseQuery = mysqli_query($con, "SELECT * FROM music_release ORDER BY RAND() LIMIT 10");

		while($row = mysqli_fetch_array($releaseQuery)) {
			



			echo "<div class='gridViewItem'>
                    <a href='album.php?id=". $row['r_id'] ."'>
                        <img src='" . $row['cover_art'] . "'>

                        <div class='gridViewInfo'>"
                            . $row['name'] .
                        "</div>
                    </a>

				</div>";



		}
	?>

</div>





<?php include("includes/footer.php"); ?>