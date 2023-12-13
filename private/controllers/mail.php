<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../static/phpmailer/src/Exception.php';
require '../static/phpmailer/src/PHPMailer.php';
require '../static/phpmailer/src/SMTP.php';

class mail
{
    public static function sendEmailVerification($email, $firstname, $lastname, $token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'mail.timmygamer.nl';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'timmy';                     //SMTP username
            $mail->Password = '3BuoPeccLXnrlgb';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info@timmygamer.nl', 'CookCook Connect');
            $mail->addAddress($email, ucfirst($firstname) . $lastname);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email verificatie';
            $mail->Body = 'Press this link to verify your email: <a href="http://recipesharingplatform/verify?token=' . $token . '">Verify</a';
            $mail->AltBody = 'Press this link to verify your email: http://recipesharingplatform/verify?token=' . $token . ' ';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}