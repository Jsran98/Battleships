
function ajaxPostHandler() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        
        if(this.readyState === 4 && this.status === 200) {
            if(this.responseText == "Error") {
                console.log("hello");
            }
            else{
                let username = this.responseText;
                document.getElementById("update").innerHTML = "<p>Welcome <i>"+username+"</i> !</p>";
                let signup = document.getElementById("sign-up");
                signup.remove();
                document.getElementById("play").style.display = "block";
                document.getElementById("logout").style.display = "block";
            }
        }
    };

    request.open("POST", "update_menu.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();
}

document.getElementById("play").style.display = "none";
document.getElementById("logout").style.display = "none";
ajaxPostHandler();

