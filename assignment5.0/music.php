<?php
    include ("top.php");
    include ("header.php");
    include ("nav.php");
?>

<h2 id='music_header'>New Music</h2>

<p class='music'>Stay tuned for these new tracks off of our upcoming album, being released in July 2016. 
Also check out the exclusive preview of our new song "Sandbox" below!</p>
<ul id='music_list'>
    <li>Culprit</li>
    <li>Sandbox</li>
    <li>Shit</li>
    <li>Wires for Breakfast</li>
</ul>

    <img id='music_img' src='pics/coldera.jpg' alt=''>

<audio controls>
    <source src="Sandbox.mp3" type="audio/ogg">
    <source src="Sandbox.mp3" type="audio/mpeg">
    Your browser does not support this audio tag.
</audio>

<p>Sign up for our <a class="inLineLinks" href='form.php'>mailing list</a> to get more samples sent to you before they're released!</p>


<?php
include ("footer.php");
?>