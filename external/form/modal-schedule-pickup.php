<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@heritagecommunitysavings.com';                     //SMTP username
    $mail->Password   = 'Hertage22ko@';                               //SMTP password
    // $mail->SMTPSecure = "ssl";            //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   // Recipients
$mail->setFrom('info@heritagecommunitysavings.com', 'Premium Bubble');
$mail->addAddress("henrydanso6@gmail.com", 'Premium Bubble Laundry Pick-up'); // Add a recipient

// Passed variables
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$address = htmlspecialchars($_POST['address']);
$service = htmlspecialchars($_POST['service']);
$datePickUp = htmlspecialchars($_POST['pickup-date']);
$dateDelivery = htmlspecialchars($_POST['delivery-date']);
$message = htmlspecialchars($_POST['message']);

// Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'Laundry Pick-up Request - Premium Bubble';
$mail->Body    = 
    'Name: ' . $name .
    '<br>Email: ' . $email .
    '<br>Phone: ' . $phone .
    '<br>Pickup Address: ' . $address .
    '<br>Service: ' . $service .
    '<br>Preferred Pickup Date: ' . $datePickUp .
    '<br>Preferred Delivery Date: ' . $dateDelivery .
    '<br>Message: ' . nl2br($message); // nl2br converts newlines to <br> tags

//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

