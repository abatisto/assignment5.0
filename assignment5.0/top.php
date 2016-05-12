<!DOCTYPE html>
<html lang="en">
    <head>

<title>COLD ERA</title>

        <meta charset="utf-8">
        <meta name="author" content="The Web Whisperers">
        <meta name="description" content="Cold Era Band Official Site">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style5-0.css" type="text/css" media="screen">
        <link rel="shortcut icon" type="image/x-icon" href="cold_era_icon.ico" />

         <?php
        $debug = false;

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//

        $domain = "//";

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

        if ($debug) {
            print "<p>Domain: " . $domain;
            print "<p>php Self: " . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre></p>";
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries. 
// 
// Common mistake: not have the lib folder with these files.
// Google the difference between require and include
//
        print "<!-- include libraries -->";

        require_once('lib/security.php');

        // notice this if statemtent only includes the functions if it is 
        // form page. A common mistake is to make a form and call the page
        // join.php which means you need to change it below (or delete the if)
        if ($path_parts['filename'] == "form") {
            print "<!-- include form libraries -->";
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
            
        }

        print "<!-- finished including libraries -->";
        ?>	

    </head>
    <!-- ################ body section ######################### -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';