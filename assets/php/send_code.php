<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;




require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

function sendCode($email,$subject,$code){
global $mail;
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kurdishsocial858@gmail.com';                     //SMTP username
        $mail->Password   = 'ywzspdxznzarieqg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('kurdishsocial858@gmail.com');    //Add a recipient
        $mail->addAddress($email);               //Name is optional
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = '
        <div dir="rtl"> 
        <h3>
        ئەم کۆدە بەکار بهێنە بۆ سەلماندنی ئیمەیڵەکەت لە نێت لینک.
        </h3>
        <p> سڵاو </p> 
        
        <p>
        بۆ ئەوەی دڵنیابین کە کە ئەم ئەکاونتە تۆ خاوەندارێتی ئەکەی، پێویستمانە کە ئیمەیڵەکەت بسەلمێنین. ئەم کۆدە تەنها یەکجار بەکاردێ،ئەگەر داوای کۆدت نەکردووە تکایە ئەم ئیمەیڵە پشتگوێبخە.
        </p>
        <br>
        <p> تکایە بۆ پاراستنی ئەکاونتی خۆت ئەم کۆدە لەگەڵ کەس هاوبەشی پێمەکە </p>
        <p> <b> کۆدی سەلماندن </b> </p>
        <h1><b>'.$code.'</b></h1>
        </div>';
        $mail->send();
    } catch (Exception $e) {
        echo "نەتوانرا نامەکە بنێردرێ {$mail->ErrorInfo}";
    }
    
}
