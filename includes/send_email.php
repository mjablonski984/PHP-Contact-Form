<?php
    require_once "includes/PHPMailer.php";
    require_once "includes/SMTP.php";
    require_once "includes/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer; // define namespace

Class SendEmail {

private $msg = []; 

public function email(){
        
        // Create instance of PHPmailer
            $mail = new PHPMailer();

        // Set mailer to use SMTP  
            $mail->isSMTP();
        // Define smtp host
            $mail->Host = "smtp.gmail.com";
        // Enable smtp authentication
            $mail->SMTPAuth = true;
        // Set type of encryption (ssl / tls)
            $mail->SMTPSecure = "tls";
        // Set port to connect smtp
            $mail->Port = "587";
        // Set gmail username
            $mail->Username = "youremail@gmail.com";
        // Set gmail password
            $mail->Password = 'yourPassword';

        // Enable HTLM
            $mail->isHTML(true); 
        // Set sender email
            $mail->setFrom($_POST['email'], $_POST['username']);
        // Set email subject
            $mail->Subject = $_POST['subject'];
        // Set email body
            $mail->Body = $_POST['email'];
        // Set recipient
            $mail->addAddress("youremail@gmail.com");

        // Finally send email 
        if ($mail->send()) {    
             $this->msg['success'] = 'Your message has been sent';
            return $this->msg;
        } else {
             $this->msg['error'] = $mail->ErrorInfo;
             return $this->msg;
        }
        // Closing smtp connection;
            $mail->smtpClose();
        }
}
