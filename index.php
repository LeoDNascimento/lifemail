<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/PHPMailer/src/Exception.php';
require_once 'vendor/PHPMailer/src/PHPMailer.php';
require_once 'vendor/PHPMailer/src/SMTP.php';
require_once 'helpers/validacao.php';

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));


/* 
    atividade: pense em algum jeito de pegar aqueles Services, pode fazer do mesmo esquema do budget la na validacao, passa igualzinho e valida 
*/

if(count($_POST)){


    try  {

        $mail = new PHPMailer(true);
            
        //Server settings
        $mail->setLanguage("en");
        $mail->SMTPDebug = 0;                                 # 
        $mail->isSMTP();                                     // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     //
        $mail->SMTPAuth = true;                                
        $mail->Username = 'leobob2000@gmail.com';     
        $mail->Password = 'maionese9.0';                           
        $mail->SMTPSecure = 'ssl';                    
        $mail->Port = 465;                                    

        //Recipients
        $mail->setFrom('leobob2000@gmail.com', 'EUUUUU');
        $mail->addAddress('leobob2000@gmail.com');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Contact " . $name;
        $mail->Body = "<b>E-mail</b>: " . $email . "." . "<br>" .
                      "<b>Address: </b>" . $email_address . "." . "<br>" .
                      "<b>Phone: </b>" . $phone . "." . "<br>" .
                      "<b>Message: </b>" . $message . "." . "<br>" ;
                      
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

    } 

    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

require_once 'views/index.php';