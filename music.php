<?php
    include ("top.php");
    include ("header.php");
    include ("nav.php");
?>

<h1 id='music_header'>New Music</h1>

<p class='music'>Stay tuned for these new tracks off of our upcoming album, being released in July 2016.</p>
<ul id='music_list'><br>
    <br>
    <li>Culprit</li><br>
    <li>Sandbox</li><br>
    <li>Shit</li><br>
    <li>Wires for Breakfast</li>
</ul>

    <img id='music_img' src='pics/coldera.jpg' alt=''>

<p id='music'>An exclusive preview of our new release, Sandbox:</p>
<audio controls="play pause volume">
    <source src="Sandbox.mp3" type="audio/ogg">
    <source src="Sandbox.mp3" type="audio/mpeg">
    Your browser does not support this audio tag.
</audio>

<p>Sign up for our <a href='form.php'>mailing list</a> to get more samples sent to you before they're released!</p>


<?php
include ("footer.php");
?>
