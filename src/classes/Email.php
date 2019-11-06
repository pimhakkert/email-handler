<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class Email
{
    //Send email to X from an unused email account
    //otherParameters are displayed at the beginning of the email
    public static function sendEmailTo($to,$subject,$message,$otherParameters = []) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.axc.nl';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'unused@pimhakkert.com';                     // SMTP username
            $mail->Password   = '5YN9qSXmwy6hEkeD';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('unused@pimhakkert.com', 'Mailer');
            $mail->addAddress($to);     // Add a recipient

            // Content
            $mail->isHTML(false);                                  // Set email format to HTML
            $mail->Subject = filter_var($subject,FILTER_SANITIZE_STRING);

            $messageStart = ""  ;
            foreach ($otherParameters as $key => $value) {
                $messageStart .= $key.": ".$value;
                $messageStart .= "\r\n";
            }

            $mail->Body    = $messageStart.PHP_EOL.filter_var($message,FILTER_SANITIZE_STRING);

            $mail->send();
            ReturnMessage::sendOk('Mail sent!');
        } catch (Exception $e) {
            ReturnMessage::sendError('001',$mail->ErrorInfo);
        }

        $mail = null;
    }

    //Send email from X to Y
    //otherParameters are displayed at the beginning of the email
    public static function sendEmailFromTo($from,$to,$subject,$message,$otherParameters = []) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.axc.nl';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'unused@pimhakkert.com';                     // SMTP username
            $mail->Password   = '5YN9qSXmwy6hEkeD';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($from);
            $mail->addAddress($to);     // Add a recipient

            // Content
            $mail->isHTML(false);                                  // Set email format to HTML
            $mail->Subject = filter_var($subject,FILTER_SANITIZE_STRING);

            $messageStart = "";

            foreach ($otherParameters as $key => $value) {
                $messageStart .= $key.": ".$value;
                $messageStart .= "\r\n";
            }

            $mail->Body    = $messageStart.PHP_EOL.filter_var($message,FILTER_SANITIZE_STRING);

            $mail->send();
            ReturnMessage::sendOk('Mail sent!');
        } catch (Exception $e) {
            ReturnMessage::sendError('001',$mail->ErrorInfo);
        }

        $mail = null;
    }
}