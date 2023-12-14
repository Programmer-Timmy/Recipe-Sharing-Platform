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
        $emailBody = '
<body>
    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Beste ' . ucfirst($firstname) . ' ' . $lastname . ',
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Welkom bij ons Receptenplatform!
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Om ervoor te zorgen dat je de best mogelijke ervaring hebt, vragen we je om je e-mailadres te bevestigen door op
        de onderstaande knop te klikken:
    </p>

    <a href="http://recipesharingplatform/verify?token=' . $token . '"
        style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px; margin-bottom: 20px;">
        Bevestig Mijn E-mail
    </a>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Door je e-mail te bevestigen, krijg je toegang tot een wereld vol heerlijke recepten, kooktips en een levendige
        community van medevoedselliefhebbers.
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Als de bovenstaande knop niet werkt, kun je de volgende link kopiëren en plakken in je browser:
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        http://recipesharingplatform/verify?token=' . $token . '
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Bedankt dat je met ons meegaat op deze culinaire reis! Als je vragen hebt of hulp nodig hebt, neem dan gerust
        contact op met ons ondersteuningsteam.
    </p>

    <p style="font-size: 16px; line-height: 1.6; color: #333;">
        Veel kookplezier!<br>
        Het Receptenplatform Team
    </p>

</body>

</html>';

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
            $mail->Port = 587;
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->setLanguage('nl');

            //Recipients
            $mail->setFrom('coockcook.connect@timmygamer.nl', 'CookCook Connect');
            $mail->addAddress($email, ucfirst($firstname) . $lastname);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Bevestig je e-mailadres om toegang te krijgen tot de volledige Receptenplatform-ervaring';
            $mail->Body = $emailBody;
            $mail->AltBody = 'druk op deze link om uw email te veriferen: http://recipesharingplatform/verify?token=' . $token . ' ';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}