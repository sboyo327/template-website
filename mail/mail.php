<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host       = 'smtp.example.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'your-email@example.com'; // SMTP username
            $mail->Password   = 'your-email-password'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('kepegawaianpkmtgpriok@gmail.com', 'Your Name'); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = "You have received a new message from the contact form on your website.<br><br>".
                             "Here are the details:<br><br>Name: $name<br>Email: $email<br>Phone: $phone<br>".
                             "Subject: $subject<br>Message:<br>$message";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
