<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->Username   = 'jan.far14@gmail.com';                     // SMTP username
        $mail->Password   = 'ornzsnrrlmsrbcfw';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('jan.far14@gmail.com', 'Jannatul');
        $mail->addAddress('jan.far14@gmail.com', 'Jannatul Fardus Muslim');     // Add a recipient

        // Content for the recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New message:'. $subject;
        $mail->Body    = '<h3>You have new message from..</h3>
                          <h4>Full Name: '.$name.'</h4>
                          <h4>Email: '.$email.'</h4>
                          <h4>Message: '.$message.'</h4>';
        $mail->AltBody = 'You have new message from '.$name.' ('.$email.'): '.$message;

        // Send email to recipient
        if($mail->send()){
            // Send confirmation email to sender
            $confirmationMail = new PHPMailer(true);
            $confirmationMail->isSMTP(); 
            $confirmationMail->SMTPAuth = true; 
            $confirmationMail->Host = 'smtp.gmail.com'; 
            $confirmationMail->Username = 'jan.far14@gmail.com'; 
            $confirmationMail->Password = 'ornzsnrrlmsrbcfw'; 
            $confirmationMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $confirmationMail->Port = 587; 

            // Recipients
            $confirmationMail->setFrom('jan.far14@gmail.com', 'Jannatul');
            $confirmationMail->addAddress($email, $name); // Add sender's email as recipient

            // Content for the sender
            $confirmationMail->isHTML(true);
            $confirmationMail->Subject = 'Confirmation: We received your message';
            $confirmationMail->Body = '<h3>Thank you for contacting us!</h3>
                                       <p>Your message has been received and we will get back to you soon.</p>
                                       <p><strong>Your message:</strong></p>
                                       <p>'.$message.'</p>';
            $confirmationMail->AltBody = 'Thank you for contacting us! Your message has been received and we will get back to you soon. Your message: '.$message;

            // Send confirmation email
            $confirmationMail->send();

            $_SESSION['status'] = "Thank you for contacting us. We will get back to you soon.";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header('Location: ../../index.php');
            exit(0);
        }
    } catch(Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header('Location: ../../index.php');
        exit(0);
    }    
}
?>
