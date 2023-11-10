var currentPlaylist = []
var audioElement;

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

function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio'); // audio is in HTML5

    this.audio.addEventListener("canplay",function() {
        //here this refers to audio
        var duration = formatTime(this.duration)
        $(".progressTime.remaining").text(duration)
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
}