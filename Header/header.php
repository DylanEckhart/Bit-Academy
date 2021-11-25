<meta name="viewport" content="width=device-width, initial-scale=1">
<header class="topnav" id="myTopnav">
    <img src="../Images/logo.png" alt="Logo" id="logo" title="Go to the Homepage">
</header>

<div class="nav-links" id="navlinks">
    <a href="javascript:void(0);" id="menuButtonOpen" class="menuButton" onclick="hideMenu()">&#10006;</a>
    <ul id="header">
        <li class="navbar"><a href="../index.php" class="navItem">Home</a> </li>
        <li class="navbar"><a href="../Pre_planning/index.php" class="navItem">Previous Planning</a></li>
        <li class="navbar"><a href="../Submit/index.php" class="navItem">Submit</a></li>
        <li class="navbar"><a href="../Admin/category.php" class="navItem">Admin</a></li>
    </ul>
</div>
<div>
<a href="javascript:void(0);" id="menuButtonClosed" onclick="showMenu()">&#9776;</a>
</div>



<script>

        let navlinks = document.getElementById("navlinks");

        function showMenu() {
            navlinks.style.display = "block";
            navlinks.style.width = "50%";
            navlinks.style.right = "0";
    }

        function hideMenu() {
            navlinks.style.width = "0";
    }


    /*send user to home page from BIT ACADEMY image*/
    var images = document.getElementsByTagName("img");
    for(var i = 0; i < images.length; i++) {
        var image = images[i];
        image.onclick = function(event) {
            window.location.href = 'index.html';
        };
    }
    /*end of send user to home page from BIT ACADEMY image*/

</script>
