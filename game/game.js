//  -   -   -   Board/Ship DOM assign    -   -   -   

    //Player View 
    var viewGameboard = document.getElementById("view-gameboard");
    var viewSquares = []; // Storing table cells ("td's") by index 

    var ships = document.querySelectorAll(".ship");
    var shipsDiv = document.querySelector(".ships-container");
    var carrierDiv = document.querySelector(".carrier-container");
    var battleshipDiv = document.querySelector(".battleship-container");
    var destroyerDiv = document.querySelector(".destroyer-container");
    var submarineDiv = document.querySelector(".submarine-container");
    var patrolboatDiv = document.querySelector(".patrolboat-container");

    //PLayer Targets

    var targetsGameboard = document.getElementById("targets-gameboard");
    var targetsSquares = [];
    
    // Ship orientation flag
    var isVertical = true;


//  -   -   -   Generating Tables/Grid  -   -   -   //

    var c100 = 0; // generic counters to place specified amount of cells in grid
    var c100_2 = 0; 

    //For Player View
    var tbl = document.createElement("table");
    for (var i = 0; i < 10; i++){
        var row = document.createElement("tr");
        for (var j = 0; j < 10; j++){
            var cell = document.createElement("td");
            cell.setAttribute("id", "vw-"+c100);
            cell.classList.add("view-cell");
            c100++;
            row.appendChild(cell);
            viewSquares.push(cell);
        }   
        tbl.appendChild(row);
    }
    viewGameboard.appendChild(tbl);


    //For Player Targets
    var tbl2 = document.createElement("table");
    for (var i = 0; i < 10; i++){
        var row = document.createElement("tr");
        for (var j = 0; j < 10; j++){
            var cell = document.createElement("td");
            cell.setAttribute("id", "ts-"+c100_2);
            cell.classList.add("target-cell");
            c100_2++;
            row.appendChild(cell);
            targetsSquares.push(cell);
        }
        tbl2.appendChild(row);
    }
    targetsGameboard.appendChild(tbl2);

//  -   -   -   Rotate functionality for ships    -   -   -   //

    function rotate (){
        if (isVertical) {
            shipsDiv.classList.toggle("ships-container-horizontal");
            carrierDiv.classList.toggle("carrier-container-horizontal");
            battleshipDiv.classList.toggle("battleship-container-horizontal");
            destroyerDiv.classList.toggle("destroyer-container-horizontal");
            submarineDiv.classList.toggle("submarine-container-horizontal");
            patrolboatDiv.classList.toggle("patrolboat-container-horizontal");

            isVertical = false;
        }
        else {
            shipsDiv.classList.toggle("ships-container-horizontal");
            carrierDiv.classList.toggle("carrier-container-horizontal");
            battleshipDiv.classList.toggle("battleship-container-horizontal");
            destroyerDiv.classList.toggle("destroyer-container-horizontal");
            submarineDiv.classList.toggle("submarine-container-horizontal");
            patrolboatDiv.classList.toggle("patrolboat-container-horizontal");

            isVertical = true;
        }
    }

    document.getElementById("rotate").addEventListener("click",rotate);

//  -   -   -   Implementation of Drag and Drop HTML API    -   -   -   // 

    //move Player Ships onto Grid
    var selectedShipNameIndex;
    var draggedShip;
    var draggedShipLength;

    for (var i = 0; i < ships.length; i++){
        ships[i].addEventListener("dragstart", dragStart);
        ships[i].addEventListener("mousedown", (e) => {
            selectedShipNameIndex = e.target.getAttribute("id");

        })
    }
    for (var i = 0; i < viewSquares.length;i++){
        viewSquares[i].addEventListener("dragover", dragOver);
        viewSquares[i].addEventListener("dragenter", dragEnter);
        viewSquares[i].addEventListener("dragleave", dragLeave);
        viewSquares[i].addEventListener("drop", dragDrop);
        viewSquares[i].addEventListener("dragend", dragEnd);

    }



    function dragStart(e){
        draggedShip = this;
        draggedShipLength = draggedShip.childElementCount;
    }

    function dragOver(e){
        e.preventDefault();
    }

    function dragEnter(e){
        e.preventDefault();
    }

    function dragLeave(e){
        e.preventDefault();
    }

    function dragDrop(){
        var shipPlayerNameWithLastId = draggedShip.lastElementChild.getAttribute("id");

        var shipClass = shipPlayerNameWithLastId.slice(0,-2);
  
    
        var selectedShipIndex = parseInt(selectedShipNameIndex.substr(-1));
   

        if(!isVertical) {
            let tempflag = false;
            for (var i = 0; i < draggedShipLength; i++){
                if(viewSquares[parseInt(this.getAttribute("id").substring(3))- selectedShipIndex + i].classList.contains("vw-taken")){
                    tempflag = true;
                }
            }
            if(!tempflag){
            for (var i = 0; i < draggedShipLength; i++){
                viewSquares[parseInt(this.getAttribute("id").substring(3))- selectedShipIndex + i].classList.add("vw-taken",shipClass);
            }
            }
            else {
                return;
            }
        }
        else if (isVertical){
            let tempflag = false;
            for (var i = 0; i < draggedShipLength; i++){
                if(viewSquares[parseInt(this.getAttribute("id").substring(3))- (selectedShipIndex*10) + i*10].classList.contains("vw-taken")){
                    tempflag = true;
                }
            }
            if(!tempflag){
            for (var i = 0; i < draggedShipLength; i++){
                viewSquares[parseInt(this.getAttribute("id").substring(3))- (selectedShipIndex*10) + i*10].classList.add("vw-taken",shipClass);
            }
            }
            else {
                return;
            }

        }



        else {
            return;
        }  
        //removes ship after placement
        shipsDiv.removeChild(draggedShip);
        if(document.querySelector(".ship") == null){
            let byebutton = document.getElementById("player-dock");
            byebutton.remove();
        }

    }

    function dragEnd(e){
        e.preventDefault();
    }


//  -   -   -   GAME SECTION    -   -   -   //


//  -   -   -   Game Vars   -   -   -   //

    var loser = false;
    var winner = false;

    var oppTimeOut = 0;

    var isTurn = false;

    var crossShot = 0;
    var crossUsed = false;

    var timeElapsed = 0;
    var tempId = 0;

    var playerMatrix = [0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0];

     class Ship {
        constructor(name,length,isSunk){
            this.name = name;
            this.length = length;
            this.isSunk = function(){
                let hitcount = 0;
                for(var i = 0; i < 100; i++){
                    if( (viewSquares[i].classList.contains(this.name)) && (viewSquares[i].classList.contains("hit")) ){
                        hitcount++;
                    }
                }
                if(hitcount == length){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    }

    var carrier = new Ship("carrier",5);
    var battleship = new Ship("battleship",4);
    var destroyer = new Ship("destroyer",3);
    var submarine = new Ship("submarine",3);
    var patrolboat = new Ship("patrolboat",2);
    var shipArray = [carrier,battleship,destroyer,submarine,patrolboat];


//  -   -   -   Helper Functions for Ajax Calls -   -   -   //

    function checknumShips(){
        var hitcount = 5;
        for(var i = 0; i < shipArray.length; i++){
            if(shipArray[i].isSunk() == true){
                hitcount--;
            }
        }
        if((hitcount <= 2) && (crossUsed == false)){
            crossShot = 1; 
            document.getElementById("prompt-main").innerHTML = "Cross shot activated ... Take your shot ...";
        
        }
        else if (crossUsed == true){
                document.getElementById("prompt-main").innerHTML = "No more charges remaining...";
                document.getElementById("prompt-main").style.color = "red";
            setTimeout(function(){ 
                document.getElementById("prompt-main").innerHTML = "Take your shot....";
                document.getElementById("prompt-main").style.color = "black";
            }, 1000);
        }
        else{
            document.getElementById("prompt-main").innerHTML = "Charging... Wait until two ships remain ...";
            setTimeout(function(){
                document.getElementById("prompt-main").innerHTML = "Take your shot....";
                document.getElementById("prompt-main").style.color = "black";
             }, 1000);
        }
    }

    function crossHandler(){
        if(isTurn == true){
            checknumShips();
        }
        else{
            return false;
        }
    }

    function dynamicTimer(){
            timeElapsed++;
            let toki = new Date(timeElapsed * 1000).toISOString().substr(11, 8);
            document.getElementById("time-elapsed").innerHTML = toki;
    }

    function initTargets(){
        for(var i = 0; i < 100; i++){
            targetsSquares[i].addEventListener('click',function(){
                clickHandler(parseInt((this.getAttribute("id")).slice(3)));
            });
        }
    }


    function updateBoard(recmatrix){
        for(var i = 0; i < 100; i++){
            if(recmatrix[i] == 2){
                viewSquares[i].style.backgroundColor = "red";
                viewSquares[i].classList.add("hit");

            }
            else if(recmatrix[i] == 3){
                viewSquares[i].style.backgroundColor = "lightblue";
                viewSquares[i].classList.add("miss");

            }
        }
    }
/*
    function numSunk(){
        let hitcount = 5;
        for(var i = 0; i < shipArray.length; i++){
            if(shipArray[i].isSunk() == true){
                hitcount--;
            }
        }
        let content = hitcount + " ships remaining";

        document.getElementById("num-ships-remain").innerHTML = content;
        updateRemainShips(hitcount);
    }
*/
    function checkIfLost(){
       var request = new XMLHttpRequest();
       request.onreadystatechange = function() {

        if(this.readyState === 4 && this.status === 200) {
           if(this.responseText == 1){
                document.getElementById("prompt-main").innerHTML = "LOSER LOSER";
                document.getElementById("display").innerHTML = "";
                loser = true;
                registerLoss();
                clearInterval(tempId);
                setTimeout(function(){location.href = '../index.php';}, 5000);
           }
           else{

           }
        }
        }

        request.open("POST", "checkIfLost.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function registerShot(shotCell,response){
        if(crossShot == 0){ 
            if(response == "invalid"){

            }
            else if(response == "miss"){
                targetsSquares[shotCell].style.backgroundColor = "lightblue";
            }
            else if(response == "hit"){
                targetsSquares[shotCell].style.backgroundColor = "red";
            }
        }
        else if(crossShot == 1){ //response received as array of hits and misses for the five slots

            var tempArr = JSON.parse(response);

            var crossIndex = [shotCell,(shotCell-10),shotCell+10,shotCell-1,shotCell+1]; // middle up down left right

            for(var i = 0; i < crossIndex.length; i++){

                if(tempArr[i] == "invalid"){

                }
                else if(tempArr[i] == "miss"){
                    targetsSquares[crossIndex[i]].style.backgroundColor = "lightblue";

                }
                else if(tempArr[i] == "hit"){
                    targetsSquares[crossIndex[i]].style.backgroundColor = "red";

                }
            }
            crossUsed = true;
            crossShot = 0;
            document.getElementById("cross-activate").style.display = "none";
            checkIfWon();
        }
    }

//  -   -   -   AJAX calls -   -   -   //

    function registerWin(){
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {

            }
        }
        
        request.open("POST", "registerWin.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("timeElap="+timeElapsed);
    }

    function registerLoss(){
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {

            }
        }
        
        request.open("POST", "registerLoss.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("timeElap="+timeElapsed);
    }

    function updateOppShips(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
              document.getElementById("opp-remain").innerHTML = (this.responseText)+" ships remaining";
            }
        }
        
        request.open("POST", "oppShips.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function updateRemainShips(){
        var hitcount = 5;
        for(var i = 0; i < shipArray.length; i++){
            if(shipArray[i].isSunk() == true){
                hitcount--;
            }
        }

        let content = hitcount + " ships remaining";

        document.getElementById("num-ships-remain").innerHTML = content;

        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
                //console.log(this.responseText);
            }
        }
        
        request.open("POST", "remainShips.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("numShips="+hitcount);
    }

    function checkIfGameExists(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
               if(this.responseText == 0){
                document.getElementById("ships-remain-container").style.display = "none";
                document.getElementById("prompt-main").innerHTML = "Opponent has left the match...";
                setTimeout(function(){location.href = '../index.php';}, 3000);
               }
            }
        }
        
        request.open("POST", "checkIfGameExists.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function closingCode(){ // set status to abandoned check if abondoned to restasr
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
               return;
            }
        }
        
        request.open("POST", "deleteLobby.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function checkIfAbandoned(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
               if(this.responseText == 1){
                
               }
            }
        }
        
        request.open("POST", "checkIfAbandoned.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }


    function checkIfWon(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
               if(this.responseText == 1){
                document.getElementById("prompt-main").innerHTML = "WINNER WINNER";
                document.getElementById("display").innerHTML = "";
                winner = true;
                registerWin();
                clearInterval(tempId);
                setTimeout(function(){location.href = '../index.php';}, 5000);
               }
               else{

               }
            }
        }
        
        request.open("POST", "checkIfWon.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function updateViewGameboard(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
                var newMatrix = JSON.parse(this.responseText);
                updateBoard(newMatrix);
            }
        }
        
        request.open("POST", "getMatrix.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }


    function fireTorpedo(shotCell){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
                registerShot(shotCell,this.responseText);
            }
        }
        
        request.open("POST", "hitLogic.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("cell_id="+shotCell+"&crossShot="+crossShot); // pass in flag for superpowers true
    }


    function initSession(){
        var request = new XMLHttpRequest();
        
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
                initTargets();
            }
        }
        
        request.open("POST", "initSession.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();
    }

    function updateMatrix(){
        var request = new XMLHttpRequest();
        
        let sendMatrix = JSON.stringify(playerMatrix);
        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
            
            }
        }
        
        request.open("POST", "updateMatrix.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("jsonData="+sendMatrix);
    };

    function timeoutLoop(){
        setTimeout(function(){ //Check If turn when not turn
            var request = new XMLHttpRequest();
        
            request.onreadystatechange = function() {

                if(this.readyState === 4 && this.status === 200) {
                    checkIfGameExists();
                    updateRemainShips();
                    updateOppShips();
                    if(this.responseText == 2){ 
                        if((loser == false) && (winner == false)){
                            checkIfWon();
                            document.getElementById("prompt-main").innerHTML = "Opponent's turn in progress...";
                            oppTimeOut++;
                            if(oppTimeOut > 60){ // if o
                                document.getElementById("prompt-main").innerHTML = "Opponent timed out...";
                                setTimeout(function(){location.href = '../index.php';}, 2000);
                            }
                            else{
                                timeoutLoop();
                            }
                        }
                        else{

                        }
                    }
                    else if(this.responseText == 1){
                        oppTimeOut = 0;
                        document.getElementById("prompt-main").innerHTML = "Your move!";
                        updateViewGameboard();
                        checkIfLost();
                        checkIfWon();
                        isTurn = true;
                    }

                }

            }

            request.open("POST", "turnCheck.php");
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();

        }, 1000);
    }


    function clickHandler(shotCell){
        checkIfGameExists();
            if(isTurn == true){
                fireTorpedo(shotCell);
                isTurn = false;
                checkIfWon();
                if(winner != true){
                    timeoutLoop();
                }
            }
            else {
                return false;
            }

    }

    function searching(){
        setTimeout(function(){ //Check If turn when not turn
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {   
                if(this.readyState === 4 && this.status === 200) {
                    if(this.responseText == 1){
                        document.getElementById("prompt-main").innerHTML = "Searching for Opponent...";
                        searching();
                    }
                    else {
                        var myVar = setInterval(dynamicTimer,1000);
                        tempId = myVar;
                        document.getElementById('opp_name').innerHTML = this.responseText;
                        document.getElementById('opp_name').style.color = "red";
                        document.getElementById("prompt-main").innerHTML = "Opponent Found!...";
                        timeoutLoop();
                    }
                }
            }

            request.open("POST", "searching.php");
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();

        }, 1000);
    }


    function init(){
        for (var i = 0; i < 100; i++){
            if(viewSquares[i].classList.contains("vw-taken")){
                playerMatrix[i] = 1;
            }
        }

        updateMatrix();
        initSession();
        window.onbeforeunload = closingCode;
        searching();
        
    }


//  -   -   -   Game Logic  -   -   -   //

    function isReady(){
        document.getElementById("ready").style.display = "none";
        document.getElementById("prompt-main").innerHTML = "Player is ready..";
        document.getElementById("cross-activate").style.display = "inline-block";
        init();
    }

    function checkIfReady(){
        if (document.querySelector(".ship") == null){
            document.getElementById("prompt-main").style.color = "black";
            isReady();

        }
        else {
            document.getElementById("prompt-main").innerHTML = "Ensure all ships are placed...";
            document.getElementById("prompt-main").style.color = "red";
        }
    }


window.onload = checkIfAbandoned();




