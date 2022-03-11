<?php
session_start();

if (isset($_GET['logout'])) {
  session_destroy();
}
?>


<!DOCTYPE html>
<html lang = "en">

<head>
<meta charset = "UTF-8">
<title></title>

<style>
    body{
      background-color: white;
    }

    a{
      text-decoration: none;
    }

    button{
      display: block;
      border:none;
      background:rgba(1, 1, 1, 0.5);
      color: blue;
    
      font-size: 35px;
      margin: 0 auto;
      width: 100%;
    }

    button:hover{
      background-color: #13284c;
      color: white;
    }

    p{
      display: block;
      border:none;
      background:rgba(1, 1, 1, 0.5);
      color: blue;
    
      font-size: 35px;
      margin: 0 auto;
      width: 100%;
    }

    #menu{
      text-align:center;
      background:rgba(1, 1, 1, 0.2);
      display: inline-block;
      position: fixed;
      top:50%;
      left:50%;
      margin-top:-50px;
     transform: translate(-50%,-50%);
    }

    #title {
      border: 1px solid white;
      font-size: 100px;
      margin:0;
      padding: 0;
      color: white;
    }
</style>
</head>




<body>


<div id = "menu">
  <h1 id = "title">Battleships</h1>
  <div id = "update">
  <a href="login_page.html"><button id = "login">Login</button></a>
  </div>
  <a id = "sign-up" href = "signup.html"><button>Sign Up</button></a>
  <a id = "play" href="./game/game.php"><button>Play</button></a>
  <a id = "leaderboard" href="leaderboard.php"><button>Leaderboards</button></a>
  <a id = "contact" href="contact.html"><button>Contact</button></a>
  <a id = "help" href="help.html"><button>Help</button></a>
  <a id = "logout" href='index.php?logout=true'><button>Logout</button></a>

</div>



<script src = "./index.js"></script>
</body>

</html>
