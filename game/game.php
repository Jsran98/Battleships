<?php

session_start();

if(!isset($_SESSION['username'])){
    header('location:../index.php');
}

?>


<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Battleship</title>
        <link rel="stylesheet" href = "game.css?v=<?php echo time(); ?>"> <!-- Reloads CSS // *required for .php-->
    </head>

    <body> 
        <div id = "wrapper">
            <div id = "notifications">
                <div id = "prompt">
                    <h1 id = "prompt-main">Place ships and ready up!</h1>
                </div>
            </div>
            <div id = "display">
                <div id = "player-view">
                    <div id = "view-gameboard-handler">
                        <div id = "view-gameboard-top">
                            <table>
                                <tr>
                                    <td></td>
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td>D</td>
                                    <td>E</td>
                                    <td>F</td>
                                    <td>G</td>
                                    <td>H</td>
                                    <td>I</td>
                                    <td>J</td>
                                </tr>
                            </table>
                        </div>
                        <div id = "view-gameboard-bottom">
                            <div id = "view-gameboard-left-header">
                                <table>
                                    <tr><td>1</td></tr>
                                    <tr><td>2</td></tr>
                                    <tr><td>3</td></tr>
                                    <tr><td>4</td></tr>
                                    <tr><td>5</td></tr>
                                    <tr><td>6</td></tr>
                                    <tr><td>7</td></tr>
                                    <tr><td>8</td></tr>
                                    <tr><td>9</td></tr>
                                    <tr><td>10</td></tr>
                                </table>
                            </div>
                            <div id = "view-gameboard">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id = "player-targets">
                    <div id = "targets-gameboard-handler">
                        <div id = "targets-gameboard-top">
                            <table>
                                <tr>
                                    <td></td>
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td>D</td>
                                    <td>E</td>
                                    <td>F</td>
                                    <td>G</td>
                                    <td>H</td>
                                    <td>I</td>
                                    <td>J</td>
                                </tr>
                            </table>
                        </div>
                        <div id = "targets-gameboard-bottom">
                            <div id = "targets-gameboard-left-header">
                                <table>
                                    <tr><td>1</td></tr>
                                    <tr><td>2</td></tr>
                                    <tr><td>3</td></tr>
                                    <tr><td>4</td></tr>
                                    <tr><td>5</td></tr>
                                    <tr><td>6</td></tr>
                                    <tr><td>7</td></tr>
                                    <tr><td>8</td></tr>
                                    <tr><td>9</td></tr>
                                    <tr><td>10</td></tr>
                                </table>
                            </div>
                            <div id = "targets-gameboard">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div id = "name-container">
                <div id = "username">
                <p>
                    <?php 
                        echo $_SESSION['username'];
                    ?>
                </p>
                </div>
                <div>
                    <p id = "opp_name">N/A</p>
                </div>
                </div>
                <div id = "ships-remain-container">
                    <div >
                        <p id = "num-ships-remain"></p>
                    </div>
                    <div>
                        <p id = "opp-remain"></p>
                    </div>
            </div>
            <div id = "docks">
                <div id = "player-dock">
                    <div id = "rotate-handler"><button id = "rotate">Rotate Ships</button></div>
                    <div class = "ships-container">
                    <div class = "ship carrier-container" draggable="true">
                        <div id = "carrier-0"></div>
                        <div id = "carrier-1"></div>
                        <div id = "carrier-2"></div>
                        <div id = "carrier-3"></div>
                        <div id = "carrier-4"></div>
                    </div>
                    <div class = "ship battleship-container" draggable="true">
                        <div id = "battleship-0"></div>
                        <div id = "battleship-1"></div>
                        <div id = "battleship-2"></div>
                        <div id = "battleship-3"></div>
                    </div>
                    <div class = "ship destroyer-container" draggable="true">
                        <div id = "destroyer-0"></div>
                        <div id = "destroyer-1"></div>
                        <div id = "destroyer-2"></div>
                    </div>
                    <div class = "ship submarine-container" draggable="true">
                        <div id = "submarine-0"></div>
                        <div id = "submarine-1"></div>
                        <div id = "submarine-2"></div>
                    </div>
                    <div class = "ship patrolboat-container" draggable="true">
                        <div id = "patrolboat-0"></div>
                        <div id = "patrolboat-1"></div>
                    </div>
                    </div>
                </div>
                <div id = "middle-space">
                    <div id = "game-info">
                        <!--<div id = "turn-number">Turn Number Box</div>-->
                        <div id = "time-elapsed">Time Elapsed Box</div>
                        <button id = "ready" onclick = "checkIfReady()">Ready!</button> 
                        <button id = "cross-activate" onclick = "crossHandler()">Cross Shot!</button>
                    </div>
                </div>
            </div>
        </div>
    <script src = "game.js"></script>
    </body>
</html> 
