let songIndex = 0;
let audioElement = new Audio("songs/1.mp3");

let masterPlay = document.getElementById("masterPlay");
let progressBar = document.getElementById("progressBar");
let volume = document.getElementById("volume");

let cover = document.getElementById("cover");
let masterSongName = document.getElementById("masterSongName");

let songs = [
    {songName:"Play-Date", filePath:"songs/1.mp3", cover:"covers/1.jpg"},
    {songName:"Stay", filePath:"songs/2.mp3", cover:"covers/2.jpg"},
    {songName:"Watermelon", filePath:"songs/3.mp3", cover:"covers/3.jpg"},
    {songName:"Middle", filePath:"songs/4.mp3", cover:"covers/4.jpg"},
    {songName:"Levitating", filePath:"songs/5.mp3", cover:"covers/5.jpg"},
    {songName:"Heat Waves", filePath:"songs/6.mp3", cover:"covers/6.jpg"},
    {songName:"No Lie", filePath:"songs/7.mp3", cover:"covers/7.jpg"},
    {songName:"Blinding Lights", filePath:"songs/8.mp3", cover:"covers/8.jpg"},
    {songName:"I Ain't Worried", filePath:"songs/9.mp3", cover:"covers/9.jpg"}
];

// Load UI
document.querySelectorAll(".songItem").forEach((el,i)=>{
    el.querySelector("img").src = songs[i].cover;
    el.querySelector(".songName").innerText = songs[i].songName;
});

// Play/Pause
masterPlay.addEventListener("click",()=>{
    if(audioElement.paused){
        audioElement.play();
        masterPlay.classList.replace("fa-play","fa-pause");
    } else {
        audioElement.pause();
        masterPlay.classList.replace("fa-pause","fa-play");
    }
});

// Progress
audioElement.addEventListener("timeupdate",()=>{
    let progress = (audioElement.currentTime/audioElement.duration)*100;
    progressBar.value = progress || 0;
});

progressBar.addEventListener("change",()=>{
    audioElement.currentTime = (progressBar.value*audioElement.duration)/100;
});

// Volume
volume.addEventListener("input",()=>{
    audioElement.volume = volume.value;
});

// Song click
document.querySelectorAll(".songItemPlay").forEach(el=>{
    el.addEventListener("click",(e)=>{
        songIndex = parseInt(e.target.id);
        playSong();
    });
});

// Next / Prev
document.getElementById("next").addEventListener("click",()=>{
    songIndex = (songIndex+1)%songs.length;
    playSong();
});

document.getElementById("previous").addEventListener("click",()=>{
    songIndex = (songIndex-1+songs.length)%songs.length;
    playSong();
});

// Auto play next
audioElement.addEventListener("ended",()=>{
    songIndex = (songIndex+1)%songs.length;
    playSong();
});

// Play function
function playSong(){
    audioElement.src = songs[songIndex].filePath;
    masterSongName.innerText = songs[songIndex].songName;
    cover.src = songs[songIndex].cover;

    audioElement.currentTime = 0;
    audioElement.play();

    masterPlay.classList.replace("fa-play","fa-pause");
}


