<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];


if(isset($_POST['email'])){
    $title = "Новый контакт для рассылки Best Tour Plan";
    $body = 'User mail: ' . $_POST['email'];
} else {
    $title = "Новое обращение Best Tour Plan";
    $body .= 'Name: ' . $_POST['name'] . ' <br />';
    $body .= 'Phone: ' . $_POST['phone'] . ' <br />';
    $body .= 'Message: ' . $_POST['message'] . ' <br />';
}


// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'buslovst@gmail.com'; // Логин на почте
    $mail->Password   = 'vocaloids13'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('buslovst@gmail.com', 'Никита Буслов'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('BuslovST@yandex.ru');  

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;    
    $mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('Location: thankyou.html');
?>

