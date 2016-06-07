<?php

$pageTitle = "Contact Website";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$reason = trim($_POST["contactReason"]);
$message = trim($_POST["message"]);
$email_body = "";

if ($name == "" OR $email == "" OR $message == "") {
    echo "<div class=\"submitError\">";
   // echo "<a href=\"con1.php\"><image src=\"images/websitelogo.png\"></a>";
    echo "<h3>You must specify values for name, email address, and message.</h3>";
    echo "</div>";
    //exit; 
    } 

    foreach( $_POST as $value ){
    if ( stripos($value,'Content-Type:') !== FALSE ){
        echo "<div class=\"submitError\">";
        echo "<a href=\"con1.php\"><image src=\"images/websitelogo.png\"></a>";
        echo "<h3>There was a problem with the information you entered.</h3>";
        echo "</div>";
        //exit;
    }
    }

    if ($_POST["address"] != "") {
    echo "<div class=\"submitError\">";
    echo "<a href=\"con1.php\"><image src=\"images/websitelogo.png\"></a>";
    echo "<h3>Your form submission has an error.</h3>";
    echo "</div>";
    //exit;
    }

    require_once("PHPMailer/class.phpmailer.php");
    $mail = new PHPMailer();

    if (!$mail->ValidateAddress($email)){
    echo "<div class=\"submitError\">";
    echo "<a href=\"con1.php\"><image src=\"images/websitelogo.png\"></a>";
    echo "<h3>You must specify a valid email address.</h3>";
    echo "</div>";
    //exit;
    }

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = "tls";
$mail->Username = "intruder.star@gmail.com";
$mail->Password = "fulltime12345";

$email_body = $email_body . "Name: " . $name . "<br>";
$email_body = $email_body . "Email Address: " . $email . "<br>";
$email_body = $email_body . "Reason for Contact: " . $reason . "<br>";
$email_body = $email_body . "Message: " . $message;

$mail->SetFrom($email, $name);

$address = "xl_kid@yahoo.com";

$mail->AddAddress($address, "eSmith Books");

$mail->Subject = "Website Contact | " . $name;

$mail->MsgHTML($email_body);

if(!$mail->Send()) {
  echo "There was a problem sending the email: " . $mail->ErrorInfo;
  //exit;
}   

header("Location: con1.php?status=thanks");
//exit;
}

?>

<center><h1>Contact Website</h1></center>

<div class="page-section">  

    <div class="contact-form">                

            <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
                <center><h4>Thank you. We'll be in contact with you soon.</h4></center>

            <?php } else { ?>

                <form method="post" action="con1.php">

                    <table>

                        <tr>
                            <th>
                                <label for="name">Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input type="email" name="email" id="email">
                            </td>
                        </tr>

                        <tr style="display: none;">
                            <th>
                                <label for="address">Address</label>
                            </th>
                            <td>
                                <input type="text" name="address" id="address">
                                <p>A Jedi would should leave this field blank.</p>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="reason">Regarding</label>
                            </th>
                            <td>
                                    <select name="contactReason" id="contactReason">
                                        <option value="questions">Questions</option>
                                        <option     value="comments">Comments</option>
                                        <option value="submissions">Book     Submissions</option>
                                        <option value="services">Services     (editing, proofreading, etc.)</option>
                                    </select>
                            </td>    
                        </tr>   

                        <tr>
                            <th>
                                <label for="message">Message</label>
                            </th>
                            <td>
                                <textarea name="message"     id="message"></textarea>
                            </td>
                        </tr>    

                    </table>
                    <input type="submit" value="Send">

                </form>

            <?php } ?>      

    </div>

</div>  
