var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist=[];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle= false;
var userLoggedIn;
var timer;

function openPage(url) {

    if(timer != null) {
        clearTimeout(timer);
    }

	if(url.indexOf("?") == -1) {
		url = url + "?";
	}

	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	$("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null,null,url);

}

function createPlaylist() { 
    console.log(userLoggedIn);
    var popup = prompt("Enter playlist name");

    if(popup != null){
        
        $.post("includes/handlers/ajax/createPlaylist.php", {name: popup, username: userLoggedIn }) // userLoggedIn is from yhe header file
        .done(function(error) { // done handles ajax returns

            if(error != "") {
                alert(error);
                return;
            }
            
            openPage("yourMusic.php"); // refresh
        });

    }
}

function deletePlaylist(playlistId) {
	var prompt = confirm("Are you sure you want to delete this playlist?");

	if(prompt == true) {

		$.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId })
		.done(function(error) {

			if(error != "") {
				alert(error);
				return;
			}

			//do something when ajax returns
			openPage("yourMusic.php");
		});


	}
}
 

function formatTime(seconds){ 
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60);
    var seconds = time - minutes*60;

    var extraZero = "";

    if(seconds < 10){
        extraZero = "0";
    }

    return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio){
    $(".progressTime.current").text(formatTime(audio.currentTime))
    $(".progressTime.remaining").text(formatTime(audio.duration-audio.currentTime))

    var progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}

function playFirstSong() {
    setTrack(tempPlaylist[0],tempPlaylist,true);
}

function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio'); // audio is in HTML5

    this.audio.addEventListener("ended", function() {
        nextSong();
    });
 
    this.audio.addEventListener("canplay",function() {
        //here this refers to audio
        var duration = formatTime(this.duration)
        $(".progressTime.remaining").text(duration)
    });

    this.audio.addEventListener("timeupdate",function(){
        if(this.duration) {
            updateTimeProgressBar(this);

        }
    });

    this.audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
	});

	this.setTrack = function(track) {
        this.currentlyPlaying = track;
		this.audio.src = track.actual_song;
	}


    this.play = function() {
        this.audio.play();
    }

    this.pause = function() { 
        this.audio.pause();
    }

    this.setTime = function(seconds) {
        this.audio.currentTime=seconds;
    }
}