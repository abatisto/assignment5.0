
<?php
// Sample code to open a plain text file

$debug = false;

if(isset($_GET["debug"])){
    $debug = true;
}

$myFileName="tour_dates";

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
print "<table>";
print "<tr>";
print "<th>City</th>";
print "<th>Venue</th>";
print "<th>Date</th>";
print "</tr>";
foreach ($records as $oneRecord) {
    if ($oneRecord[0] != "") {  //the eof would be a "" 
        print "\n\t<tr>";
        //print out values
        print '<td id=city>' . $oneRecord[0] . '</td>';
        print '<td id=venue>' . $oneRecord[1] . '</td>';
        print '<td id=date>' . $oneRecord[2] . '</td>';
        print "\n\t</tr>";
    }
}

print "</table>";

if ($debug){
print "<p>End of processing.</p>\n";}

?>