<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
 
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    //Server settings 
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->SMTPAuth = false;
    $mail->Port = 25;
    //$mail->Username = 'ebid@sportkingemail.co.in';
    //$mail->Password = 'mailsvr.mailmax.in';
    $mail->SMTPOptions = array(
      'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        ); 
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //Recipients
    $mail->setFrom('neelbhardwaj97@gmail.com');
    $mail->addAddress('phpspider97@gmail.com');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

 
die;
//Create an instance; passing `true` enables exceptions
$mailObj = new PHPMailer();

try {
    
    //Server settings  
    //$mailObj->SMTPDebug = SMTP::DEBUG_OFF;
    
     $mailObj->SMTPDebug = SMTP::DEBUG_SERVER;                     
     //$mailObj->isSMTP();                                          
    // $mail->Host       = 'smtp.gmail.com';                     
    // $mail->SMTPAuth   = true;                              
    // $mail->Username   = 'neelbhardwaj97@gmail.com';               
    // $mail->Password   = 'yyzsrlnkdoelxrcl';                         
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port       = 587;                                     
     
    
    $mailObj->isSMTP();
    $mailObj->Host = 'localhost';
    $mailObj->SMTPAutoTLS = false;
    $mailObj->Port = 465;
    $mailObj->setFrom(MAIL_SET_FROM);
    $mailObj->addBCC(MAIL_BCC);
    $mailObj->isHTML(true);

    //$mailObj->setFrom('neelbhardwaj97@gmail.com');
 
    //Recipients
    //$mailObj->setFrom('from@example.com', 'Mailer');
    $mailObj->addAddress('phpspider97@gmail.com');     //Add a recipient
    
    
    //$mailObj->addAddress('ellen@example.com');               //Name is optional
    //$mailObj->addReplyTo('info@example.com', 'Information');
    //$mailObj->addCC('cc@example.com');
    //$mailObj->addBCC('bcc@example.com');

    //Attachments
        //$mailObj->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mailObj->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    //$mailObj->isHTML(true);                                  //Set email format to HTML
    $mailObj->Subject = 'Here is the subject';
    $mailObj->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mailObj->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //pr($mailObj); die('__1');
    $mailObj->send();
    
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailObj->ErrorInfo}";
}