<?php

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];
$phone = $_FILES['phone'];

$title = "Бросить вызов";
$body = "
<h2>Новое письмо</h2>
<b>Наименование компании:</b> $text<br>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Почта:</b> $email<br><br>
";

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    $mail->Host       = 'smtp.gmail.com'; 
    $mail->Username   = 'narutoworkzumaki'; 
    $mail->Password   = 'iwwrlzwygixqjexb'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('narutoworkzumaki@gmail.com', 'Итачи Учиха'); 

    
    $mail->addAddress('narutoworkzumaki@gmail.com');  


$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}


echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);


