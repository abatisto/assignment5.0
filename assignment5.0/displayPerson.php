<?php
include ("top.php");
include ("nav.php");
include ("header.php");

    $debug = false;
    $personId = $_GET["pid"];

    if(isset($_GET["debug"])){
        $debug = true;
    }

    $myFileName="aboutdata";

    $fileExt=".csv";

    $filename = $myFileName . $fileExt;
    
    $record=array();

    if ($debug){ print "\n\n<p>filename is " . $filename;
    }
    $file=fopen($filename, "r");

// the variable $file will be empty or false if the file does not open
    if($file){
        if($debug) {print "<p>File Opened</p>\n";
    }}

        if($debug) {print "<p>Begin reading data into an array.</p>\n";
        }
    // This reads the first row, which in our case is the column headers
        $headers[]=fgetcsv($file);
    
        if($debug) {
            print "<p>Finished reading headers.</p>\n";
            print "<p>My header array<p><pre> "; print_r($headers); print "</pre></p>";
        }
    // the while (similar to a for loop) loop keeps executing until we reach 
// the end of the file at which point it stops. the resulting variable 
// $records is an array with all our data.

        while(!feof($file)){
            $records[]=fgetcsv($file);
            if ($records[count($records) - 1][0] == $personId) {
            $record = end($records);
    }
        }
    
    //closes the file
        fclose($file);
    
        if($debug) {
            print "<p>Finished reading data. File closed.</p>\n";
            print "<p>My data array<p><pre> "; print_r($records); print "</pre></p>";
        }
// ends if file was opened

// display the data
foreach ($records as $oneRecord) {
    if ($oneRecord[0] != ""&&$oneRecord[0]==$personId) {  //the eof would be a "" 
        print "\n\t";
        //print out values
        print '<h3 class="about">' . $oneRecord[1] . "-<i>" .  $oneRecord[2] .'</i></h3>';
        print '<img id="about" src="' . $oneRecord[3] . '"alt="' . $oneRecord[1] . '"</img>';
    }
}

print "<a id='back' href=about.php><-Back</a>";

if ($debug){
print "<p>End of processing.</p>\n";}



            