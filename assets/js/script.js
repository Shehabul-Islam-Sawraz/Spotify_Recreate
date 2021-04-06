var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeatSong = false;
var shuffle = false;
var userLoggedIn;
  

window.addEventListener("popstate", function ( event ) {
  //console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
  //var page = encodeURI(document.location);
  window.location.reload();
});

function openPage(url){
    //console.log(url);
    if(url.indexOf("?") == -1){
        url+="?";
    }
    var page = encodeURI(url+"$userLoggedIn="+userLoggedIn);
    $("#mainContent").load(page);
    $("body").scrollTop(0);
    history.pushState(null,null,url);
    //console.log(page);
}

function formatTime(seconds){
    var time = Math.round(seconds);
    var min = Math.floor(time/60);
    var sec = time - min*60;
    var extraZero;
    if(sec<10){
        extraZero = "0";
    }
    else{
        extraZero = "";
    }
    return min + ":" + extraZero + sec;
}
function updateTimeProgressBar(audio){
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration-audio.currentTime));
    var progress = (audio.currentTime / audio.duration)* 100;
    $(".playBackBar .progress").css("width",progress+"%");
}

function updateVolumeProgressBar(audio){
    var volume = audio.volume*100;
    $(".volumeBar .progress").css("width",volume+"%"); 
}

function playFirstSong()
{
    setTrack(tempPlaylist[0],tempPlaylist,true);
}

function Audio()
{
    this.currentPlaying;
    this.audio = document.createElement('audio');
    //This event listener is for changing to next song after a song has ended.
    this.audio.addEventListener("ended",function(){
        nextSong();
    });
    this.audio.addEventListener("canplay",function(){
        var duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });
    this.audio.addEventListener("timeupdate",function(){
        if(this.duration){
            updateTimeProgressBar(this);
        }
    });
    this.audio.addEventListener("volumechange",function(){
        updateVolumeProgressBar(this);
    });


    this.setTrack = function(track){
        this.currentPlaying = track; 
        this.audio.src = track.path;
    }
    this.play = function(){
        this.audio.play();
    }
    this.pause = function(){
        this.audio.pause();
    }
    this.setTime = function(seconds){
        this.audio.currentTime = seconds;
    }
}
