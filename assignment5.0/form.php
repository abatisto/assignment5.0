<?php
include "top.php";
include "header.php";
include "nav.php";


// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.

$debug = false;

// If statement to help find errors later

if (isset($_GET["debug"])) {
    $debug = true;
}

if ($debug) {
    print "<p>DEBUG MODE IS ON</p>";
}


//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;



//
// SECTION: 1c form variables
//
// Initialize variables for each form element
// ***in the order they appear on the form

$firstName= "";
$lastName="";
$email = "abatisto@uvm.edu";
$ageRange = "10-19";
$gender = "Male";
$mailList = true;
$tourDates = false;
$contest = false;



// SECTION: 1d form error flags
//
// Initialize Error Flags for each form element
// ****in the order they appear in section 1c.

$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;




// SECTION: 1e misc variables
//
// create array to hold error messages 

$errorMsg = array(); 
 
// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?

$mailed=false;


// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

    
    //
    // SECTION: 2a Security
    // 
    if (!securityCheck($thisURL)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

    
    
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.

    
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[]= $email;
    
    $ageRange = htmlentities($_POST["lstAgeRange"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $ageRange;
    
    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;
    
    if (isset($_POST["chkMailList"])) {
        $mailList = true;
    } else {
        $mailList = false;
    }
    $dataRecord[] = $mailList;
            
    if (isset($_POST["chkTourDates"])) {
        $tourDates = true;
    } else {
        $tourDates = false;
    }
    $dataRecord[] = $tourDates;
            
    if (isset($_POST["chkContest"])) {
        $contest = true;
    } else {
        $contest = false;
    }
    $dataRecord[] = $contest;
    
       
         
    
    // SECTION: 2c Validation

    
    
    
    
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    }
    elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra characters.";
        $firstNameERROR = true;
    }
    
    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    }
    elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra characters.";
        $lastNameERROR = true;
    }
    
    
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }
    

    
    
    
    
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        if ($debug){
            print "<p>Form is valid</p>"; }   
    
             

        
        
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.
        
        $fileExt = ".csv";
        $myFileName = "data/mailinglist"; // NOTE YOU MUST MAKE THE FOLDER !!!

        $filename = $myFileName . $fileExt;

        if ($debug){
            print "\n\n<p>filename is " . $filename;
        }
    
        // now we just open the file for append
        $file = fopen($filename, 'a');
    
        // write the forms informations
        fputcsv($file, $dataRecord);
    
        // close the file
        fclose($file);
     
    
    
    
    
    
    
    
        
        
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).
        $message= '<h2>Your information:</h2>';
        
        foreach ($_POST as $key => $value) {
            if ($key=="chkMailList" || $key=="chkTourDates" || $key=="chkContest"){
            $value="Checked";
            }
            
        
            
            if ($key!="btnSubmit"){
                
                $message .= "<p class=confirm>";
            
                //breaks up the form names into words.
            
                $camelCase= preg_split('/(?=[A-Z])/', substr($key, 3));
            
                foreach ($camelCase as $one) {
                    $message .= $one . " ";
                }
            
                $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
            
            }
     
        
        }
    
    
    
    
    
    
    
    
    
    
       
            
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        
        $to= $email; //the person who filled out the form
        $cc= "";
        $bcc= "";
        
        $from = "Cold Era <noreply@colderavt.com>";
        
        $todaysDate = strftime("%x");
        $subject="Cold Era Mailing List " . $todaysDate;
        
        $mailed= sendMail($to, $cc, $bcc, $from, $subject, $message);
   
        
    } // end form is valid

}   // ends if form was submitted.




// SECTION 3 Display Form
//
?>

<article id="main">
    <h2>Subscribe</h2>

    <?php
    
    //
    // SECTION 3a. 
    // 
    // If its the first time coming to the form or there are errors we are going
    // to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit 
        print "<h2 id= processed> Your Request has ";
    
        if (!$mailed) {
            print "not ";
        }
    
        print "been processed</h2>";
    
        print "<p class=confirm>A copy of this message has ";
    
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p class=confirm>To: " . $email . "</p>";
    
        print "<p class=confirm2>Mail Message:</p>";
    
        print $message;
        die;
    
    } else {
    
     
        
        
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
   
    if ($errorMsg) {
        print '<div id="errors">' . "\n";
        print "<h2 id='mistakes'>Your form has the following mistakes that need to be fixed:</h2>\n";
        print "<ol>\n";
        
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        
        print "</ol>\n";
        print "</div>\n";
    }
    }
        
        
        // SECTION 3c html Form
        //
        
    ?>
    
    
    
    




    <p>
        Please complete the form below to subscribe to the Cold Era mailing list!.  You will receive band updates, new 
        music, tour dates, and much more exclusive Cold Era content.  Upon subscribing, you will receive a confirmation email with
        your information. You can also choose to be entered into our monthly contest where you can win awesome freebies like concert tickets, band 
        merch, free song downloads, and opportunities to get back stage and meet the band.  You will not want to miss out,
        so please subscribe today!
    </p>
   
    
</article>


<article>
    <form action='../assignment5.0/form.php'
          method="post"
          id='frmSubscribe'>
    
        <fieldset class='wrapper'>
            <legend>Please Join Us!</legend>
            
            <fieldset class='wrapper2'>
                <legend>Complete the following form</legend>
                
                <fieldset class='contactInfo'>
                    <legend>Contact Information</legend>
                    <label for="txtFirstName" class="required">First Name
                        <input type="text"
                               id="txtFirstName"
                               name="txtFirstName"
                               value="<?php print $filename;?>"
                               tabindex="50"
                               maxlength="35"
                               placeholder="Enter your first name"
                               <?php if ($firstNameERROR) {print 'class="mistake"';} ?>
                               onfocus="this.select()"
                               autofocus>
                    </label>
                    
                    <label for="txtLastName" class="required">Last Name
                        <input type="text"
                               id="txtLastName"
                               name="txtLastName"
                               value="<?php print $filename;?>"
                               tabindex="70"
                               maxlength="45"
                               placeholder="Enter your last name"
                               <?php if ($firstNameERROR) {print 'class="mistake"';} ?>
                               onfocus="this.select()"
                               >
                    </label>
                    
                    <label for='txtEmail' class='required'>Email
                        <input type='text' 
                               id='txtEmail' 
                               name='txtEmail'
                               value='<?php print $email;?>'
                               tabindex="150"
                               maxlength="40"
                               placeholder="Please enter valid email"
                               <?php if ($emailERROR) {print 'class="mistake"';} ?>
                               onfocus="this.select()">
                        
                    </label>
                </fieldset>
                
                <fieldset class="listbox">
                    <label for="lstAgeRange">Age Range</label>
                    <select id="lstAgeRange"
                            name="lstAgeRange"
                            tabindex="200">
                        <option <?php if($ageRange=="0-9") {print"selected";}?>
                            value="0-9">0-9</option>
                        <option <?php if($ageRange=="10-19") {print"selected";}?>
                            value="10-19">10-19</option>
                        <option <?php if($ageRange=="20-29") {print"selected";}?>
                            value="20-29">20-29</option>
                        <option <?php if($ageRange=="30-39") {print"selected";}?>
                            value="30-39">30-39</option>
                        <option <?php if($ageRange=="40-49") {print"selected";}?>
                            value="40-49">40-49</option>
                        <option <?php if($ageRange=="50-59") {print"selected";}?>
                            value="50-59">50-59</option>
                        <option <?php if($ageRange=="60+") {print"selected";}?>
                            value="60+">60+</option>
                    </select>
                </fieldset>
                
                <fieldset class="radio">
                    <legend>What is your gender?</legend>
                    <label>
                        <input type="radio"
                               id="radMale"
                               name="radGender"
                               value="Male"
                               <?php if ($gender == "Male") {print 'checked';}?>
                               tabindex="250">Male</label>
                    
                    <label>
                        <input type="radio"
                               id="radFemale"
                               name="radGender"
                               value="Female"
                               <?php if ($gender == "Female") {print 'checked';}?>
                               tabindex="260">Female</label>
                    
                    <label>
                        <input type="radio"
                               id="radOther"
                               name="radGender"
                               value="Other"
                               <?php if ($gender == "Other") {print 'checked';}?>
                               tabindex="270">Other</label>
                    
                </fieldset>
                
                <fieldset class="checkbox">
                    <legend>Options:</legend>
                    <label>
                        <input type="checkbox"
                               id="chkMailList"
                               name="chkMailList"
                               value="mailList"
                               <?php if ($mailList) {print "checked";} ?>
                               tabindex="300">Subscribe to Cold Era's mailing list.</label>
                    
                    <label>
                        <input type="checkbox"
                               id="chkTourDates"
                               name="chkTourDates"
                               value="tourDates"
                               <?php if ($tourDates) {print "checked";} ?>
                               tabindex="310">Notify me when Cold Era plays near me.</label>
                    
                    <label>
                        <input type="checkbox"
                               id="chkContest"
                               name="chkContest"
                               value="contest"
                               <?php if ($contest) {print "checked";} ?>
                               tabindex="320">Enter me in the monthly contest.
                    
                    </label>
                       
     
            </fieldset>
                
                
                
            <fieldset class="button">
            <legend></legend>
            <input type="submit" 
                 id="btnSubmit" 
                 name="btnSubmit" 
                 value="Join" 
                 tabindex="800" 
                 class="button">
            </fieldset>          
        </fieldset>
        </fieldset>                           
    </form>
</article>

<?php
include("footer.php");
?>

</body>
</html>