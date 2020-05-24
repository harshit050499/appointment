<?php

function send_mail($mailto,$creator,$time,$date){
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
 <tr>
  <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
  	<p>YOUR MEETING IS CONFIRMED WITH'.$creator.'</p>
</td>
</tr>
<td>
	<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td>
   
  </td>
 </tr>
 <tr>
  <td style="padding: 20px 0 30px 0;" align="center">
   <p>DATE:'.$date.'</p><br><p>TIME:'.$time.'</p>
  </td>
 </tr>
</table>
</td>
 </tr>
</table>
</body>
</html>';

				require 'mailsys/PHPMailerAutoload.php';
				require 'mailsys/class.phpmailer.php';
				require 'mailsys/class.phpmaileroauth.php';
				require 'mailsys/class.phpmaileroauthgoogle.php';
				require 'mailsys/class.smtp.php';

				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->Mailer = "smtp"; 
				 $mail->SMTPDEBUG=1;  
				$mail->SMTPAuth = true;                                    // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;  // TCP port to connect to  
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Username = 'harshitmandhyani47@gmail.com'   ;              // SMTP username
				$mail->Password = '____________'; // SMTP password
				$mail->setFrom('harshitmandhyani47@gmail.com');
				$mail->addReplyTo('harshitmandhyani47@gmail.com');
				

				$mail->Subject = "Meeting Confirmation"; // Add a recipient
				$mail->Body    = $body;
				$mail->addAddress($mailto);    
				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				    var_dump($mail);
				} //else {
				//     echo 'Message has been sent';
				// }
}

?>
