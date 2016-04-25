<nav>
    <ul>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_home.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="index.php"><img class="navimg" src="navpics/nav_home.png"alt=""</img></a></li>';
        }
        

     
        
        if ($path_parts['filename'] == "about") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_about.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="about.php"><img class="navimg" src="navpics/nav_about.png"alt=""</img></a></li>';
        }
        
        
        if ($path_parts['filename'] == "tour") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_tour.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="tour.php"><img class="navimg" src="navpics/nav_tour.png"alt=""</img></a></li>';
        }
        
        
        if ($path_parts['filename'] == "music") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_music.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="music.php"><img class="navimg" src="navpics/nav_music.png"alt=""</img></a></li>';
        }
        
        if ($path_parts['filename'] == "photos") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_photos.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="photos.php"><img class="navimg" src="navpics/nav_photos.png"alt=""</img></a></li>';
        }
        
                
        if ($path_parts['filename'] == "form") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_join.png"alt=""</img></li>';
        }
        else {
            print '<li class="links"><a href="form.php"><img class="navimg" src="navpics/nav_join.png"alt=""</img></a></li>';
        }
        
        
        ?>
    </ul>
</nav>
