<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require base_path('vendor/autoload.php');




class Mail extends Model
{
    use HasFactory;

    private $_mailer,
    $_passed = false,
    $_error = false,
    $_fromEmail = null,
    $_name = null,
    $_smtpHost = null,
    $_smtpPort = null,
    $_userName = null,
    $_smtpPassword = null;


public function __construct()
{
    $this->_mailer = new PHPMailer(true);
    $this->get_information();
}







public function get_information(){
    $emailSettings =  DB::table('settings')->where('id', 1)->first();
    if($emailSettings)
    {
        $this->_name = $emailSettings->from_name ? $emailSettings->from_name : null;
        $this->_fromEmail = $emailSettings->from_email ? $emailSettings->from_email : null;
        $this->_smtpHost = $emailSettings->smtp_host ? $emailSettings->smtp_host : null;
        $this->_smtpPort = $emailSettings->smtp_port ? $emailSettings->smtp_port : null;
        $this->_userName = $emailSettings->smtp_username ? $emailSettings->smtp_username : null;
        $this->_smtpPassword = $emailSettings->smtp_password ? $emailSettings->smtp_password : null;
    }
}






public function mail($params = array())
{
 $this->_error = false;
 if(count($params))
 {
     if(empty($this->_name))
     {
         $this->_error[] = ['name' => 'Sender name is required for sedning email'];
     }
     if(empty($params['to']))
     {
         $this->_error[] = ['to' => 'Recipient email is required'];
     }
     if(empty($this->_fromEmail))
     {
         $this->_error[] = ['from' => 'Sender email is required'];
     }
 }
 if(empty($this->_error))
 {
     $this->_passed = true;
     $this->_toEmail = $params['to'];
     $this->_image =  !empty($params['image']['name']) ? $params['image'] : '';
     $this->_body =   !empty($params['body']) ? $params['body'] : '';
     $this->_subject = !empty($params['subject']) ? $params['subject'] : '';
 }
 return $this;
}

// smtp_port = 465


public function send_email()
{
    $this->SMTPDebug = 0;  
    $this->_mailer->isSMTP();
    $this->_mailer->Host = $this->_smtpHost;
    $this->_mailer->SMTPAuth = true;

    $this->_mailer->Username = $this->_userName;
    $this->_mailer->Password = $this->_smtpPassword;
    $this->_mailer->Port = $this->_smtpPort;
    $this->_mailer->SMTPSecure = 'ssl';

    //email settings
    $this->_mailer->isHTML(true);
    $this->_mailer->setFrom($this->_fromEmail, $this->_name);
    $this->_mailer->addAddress($this->_toEmail);
    $this->_mailer->Subject =  $this->_subject;
    $this->_mailer->Body =  $this->_body;

    if(!empty($this->_image))
    {
        $this->_mailer->addAttachment($this->_image['tmp_name'], $this->_image['name']);
    }

    if(empty($this->error_count))
    {
        if($this->_mailer->send())
        {
            return true;
        }
    }
    return $this;
}




public function error()
{
 return $this->_error;
}



public function passed()
{
 return $this->_passed;
}




//Instantiation and passing `true` enables exceptions
// $mail = new PHPMailer(true);


// try {
//     //Server settings
//     $mail->SMTPDebug = 0;                     
//     $mail->isSMTP();                                            
//     $mail->Host       = 'smtp.gmail.com';                    
//     $mail->SMTPAuth   = true;                                   
//     $mail->Username   = 'anonyecharles@gmail.com';                     
//     $mail->Password   = '$boogie30var30';                              
//     $mail->SMTPSecure = 'tls';        
//     $mail->Port       = 587;                                   

//     //Recipients
//     $mail->setFrom('anonyecharles@gmail.com', 'Mailer');
//     $mail->addAddress('anonyecharles@gmail.com', 'Joe User');     //Add a recipient
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments 
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

//     $mail->send();
//     echo 'Message has been sent';
//     dd('anonyecharles@gmail.com');
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     dd('anonyecharles@gmail.com');
// }







// ********** SAMPLE OF HOW TO USE MAIL ************//
// $mail = new Mail();
// $send = $mail->mail([
//             'to' => example@gmail.com,
//             'subject' => 'forgot password',
//             'body' => body of the message,
//         ]);


// $send->passed() // if email is credentials passed

// $send->send_email() // send mail 

// end
}






























//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require 'vendor/autoload.php';

// //Instantiation and passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'user@example.com';                     //SMTP username
//     $mail->Password   = 'secret';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//     //Recipients
//     $mail->setFrom('from@example.com', 'Mailer');
//     $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
//     $mail->addAddress('ellen@example.com');               //Name is optional
//     $mail->addReplyTo('info@example.com', 'Information');
//     $mail->addCC('cc@example.com');
//     $mail->addBCC('bcc@example.com');

//     //Attachments
//     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }











// https://stackoverflow.com/questions/37524275/smtp-error-could-not-authenticate-message-could-not-be-sent-mailer-error-smt