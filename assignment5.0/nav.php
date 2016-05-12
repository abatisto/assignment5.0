<nav>
    <ul>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage"> <img class="navimg" src="navpics/nav_home.png" alt="home"></li>';
        }
        else {
            print '<li class="links"> <a href="index.php"> <img class="navimg" src="navpics/nav_home.png" alt="home"></a></li>';
        }
        

     
        
        if ($path_parts['filename'] == "about") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_about.png" alt="about"></li>';
        }
        else {
            print '<li class="links"><a href="about.php"><img class="navimg" src="navpics/nav_about.png" alt="about"></a></li>';
        }
        
        
        if ($path_parts['filename'] == "tour") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_tour.png" alt="tour"></li>';
        }
        else {
            print '<li class="links"><a href="tour.php"><img class="navimg" src="navpics/nav_tour.png" alt="tour"></a></li>';
        }
        
        
        if ($path_parts['filename'] == "music") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_music.png" alt="tour"></li>';
        }
        else {
            print '<li class="links"><a href="music.php"><img class="navimg" src="navpics/nav_music.png" alt="tour"></a></li>';
        }
        
        if ($path_parts['filename'] == "photos") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_photos.png" alt="phots"></li>';
        }
        else {
            print '<li class="links"><a href="photos.php"><img class="navimg" src="navpics/nav_photos.png" alt="photos"></a></li>';
        }
        
                
        if ($path_parts['filename'] == "form") {
            print '<li class="activePage"><img class="navimg" src="navpics/nav_join.png" alt="join"></li>';
        }
        else {
            print '<li class="links"><a href="form.php"><img class="navimg" src="navpics/nav_join.png" alt="join"></a></li>';
        }
        
        
        ?>
    </ul>
</nav>
