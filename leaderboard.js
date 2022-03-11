

function win(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
    if(this.readyState === 4 && this.status === 200) {
       let currTbl = document.getElementById("leadtable");
       currTbl.remove();
       document.getElementById("insert").innerHTML = this.responseText;
    }
    }
    request.open("POST", "leaderboardSort.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("indicate=won");
}

function play(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
    if(this.readyState === 4 && this.status === 200) {
        let currTbl = document.getElementById("leadtable");
        currTbl.remove();
        document.getElementById("insert").innerHTML = this.responseText;
    }
    }
    request.open("POST", "leaderboardSort.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("indicate=play");
}

function timez(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
    if(this.readyState === 4 && this.status === 200) {
        let currTbl = document.getElementById("leadtable");
        currTbl.remove();
        document.getElementById("insert").innerHTML = this.responseText;
    }
    }
    request.open("POST", "leaderboardSort.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("indicate=time");
}


function byWon(){
    win();
}

function byPlay(){
   play();
}

function byTime(){
    timez();
}

function goBack(){
    location.href = 'index.php';
}