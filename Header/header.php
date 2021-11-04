<link rel="stylesheet" href="style.css">
<header class="topnav" id="myTopnav">
    <img src="../Images/logo.png" alt="Logo" id="logo" title="Go to the Homepage">
    <ul id="header">
        <li class="navbar"><a href="../Pre_planning/index.php" class="navItem">Overview</a></li>
        <li class="navbar"><a href="../Submit/index.php" class="navItem">Submit</a></li>
        <li class="navbar"><a href="../Admin/index.php" class="navItem">Admin</a></li>
        <li><a href="javascript:void(0);" style="font-size:25px;" id="menuButton" onclick="showNavBar()">&#9776;</a></li>
    </ul>
</header>
<script>
    /*send user to home page from BIT ACADEMY image*/
    var images = document.getElementsByTagName("img");
    for(var i = 0; i < images.length; i++) {
        var image = images[i];
        image.onclick = function(event) {
            window.location.href = 'index.html';
        };
    }
    /*end of send user to home page from BIT ACADEMY image*/

    function showNavBar() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
            document.getElementById("menuButton").style.transform = "rotate(-90deg)";
        } else {
            x.className = "topnav";
            document.getElementById("menuButton").style.transform = "rotate(0deg)";
        }
    }
</script>
