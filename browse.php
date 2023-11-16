<?php 
include("includes/includedFiles.php");
?>


<h1 class="pageHeadingBig">You Might Also Like</h1>
<h2>Most Popular Release</h2>
<div class="gridViewContainer">

	<?php
		
		$releaseQuery = mysqli_query($con, "SELECT
		music_release.r_id as r_id,music_release.name as naam,cover_art,
		SUM(song.number_of_plays) AS total_plays
		FROM
			music_release
		JOIN
			song ON music_release.r_id = song.r_id
		GROUP BY
			music_release.r_id
		ORDER BY
			total_plays desc;");

		while($row = mysqli_fetch_array($releaseQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=". $row['r_id'] . "\")'>
                        <img src='" . $row['cover_art'] . "'>

                        <div class='gridViewInfo'>"
                            . $row['naam'] .
                        "</div>
                    </span>

				</div>";



		}
	?>

</div>

<h2>Most Popular Artists</h2>
<div class="gridViewContainer">

	<?php
		
		$artistQuery = mysqli_query($con, "SELECT
		artist.a_id as aid,
		artist.name as aname,
		SUM(song.number_of_plays) AS total_plays
		FROM
			artist
		JOIN
			song ON artist.a_id = song.a_id
		GROUP BY
			artist.a_id, artist.name
		ORDER BY
			total_plays DESC;
	");

		while($row = mysqli_fetch_array($artistQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $row['aid'] . "\")'>
                        <img src='assets/images/profile-pics/dp1.png'>

                        <div class='gridViewInfo'>"
                            . $row['aname'] .
                        "</div>
                    </span>

				</div>";



		}
	?>

</div>





