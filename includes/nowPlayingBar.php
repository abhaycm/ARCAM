<?php
$songQuery = mysqli_query($con,"select s_id from song order by rand() limit 10");
$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray,$row['s_id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>

$(document).ready(function() {
	currentPlaylist = <?php echo $jsonArray; ?>;
	audioElement = new Audio();
	setTrack(currentPlaylist[0], currentPlaylist, false);
});


function setTrack(trackId, newPlaylist, play) {
    // php executed before this whole file is loaded
	$.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) { // the ajax call
		
		var track = JSON.parse(data);

        $(".trackName span").text(track.name);

        $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.a_id }, function(data){
            var artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
        });

        $.post("includes/handlers/ajax/getReleaseJson.php", { releaseId: track.r_id }, function(data){
            var release = JSON.parse(data);
            $(".albumLink img").attr("src", release.cover_art);
        });

		audioElement.setTrack(track);
		playSong()
	});

	if(play == true) {
		audioElement.play();
	}
}


function playSong() {

    if(audioElement.audio.currentTime == 0){
        $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.s_id });
    }

    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong() {
    $(".controlButton.pause").hide();
    $(".controlButton.play").show();
    audioElement.pause();
}


</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="" class="albumArtwork" alt="">
                </span>

                <div class="trackInfo">

                    <span class="trackName">
                        <span></span>
                    </span>

                    <span class="artistName">
                        <span></span>
                    </span>

                </div>
            </div>
        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle Button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="controlButton previous" title="Previous Button">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>
                    <button class="controlButton play" title="Play Button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>
                    <button class="controlButton pause" title="Pause Button" style="display:none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>
                    <button class="controlButton next" title="Next Button">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>
                    <button class="controlButton repeat" title="Repeat Button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>
                </div>

                <div class="playbackBar">

                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
            
                </div>
            </div>
        </div>  
            
        <div id="nowPlayingRight">
            <div class="volumeBar">

                <button class="controlButton volume" title="Volume button">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>

                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>