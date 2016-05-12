
<?php
// Sample code to open a plain text file

$debug = false;

if(isset($_GET["debug"])){
    $debug = true;
}

$myFileName="aboutdata";

$fileExt=".csv";

$filename = $myFileName . $fileExt;

if ($debug) {print "\n\n<p>filename is " . $filename;
}

$file=fopen($filename, "r");

// the variable $file will be empty or false if the file does not open
if($file){
    if($debug) {print "<p>File Opened</p>\n";
}}

// the variable $file will be empty or false if the file does not open
    
    if($debug) {print "<p>Begin reading data into an array.</p>\n";
    }

    // This reads the first row, which in our case is the column headers
    //$headers[]=fgetcsv($file);
    
    if($debug) {
        print "<p>Finished reading headers.</p>\n";
        print "<p>My header array<p><pre> "; print_r($headers); print "</pre></p>";
    }
    // the while (similar to a for loop) loop keeps executing until we reach 
// the end of the file at which point it stops. the resulting variable 
// $records is an array with all our data.

    while(!feof($file)){
        $records[]=fgetcsv($file);
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
    if ($oneRecord[0] != ""&&$oneRecord[0] !="id" ) {  //the eof would be a "" 
        print "\n\t";
        print '<h3 class="members"><a class="members" href="displayPerson.php?pid=' . $oneRecord[0] . '">' . $oneRecord[1] . "-<i>" . $oneRecord[2] . "</i></a></h3>";
     
    }
}


if ($debug){
print "<p>End of processing.</p>\n";}

?>