<?php

$post = (!empty($_POST)) ? true : false;

if($post)
{
$subject = 'Оформить заявку';
$email = trim($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$error = '';

if(!$name)
{
$error .= 'Пожалуйста введите ваше имя.<br />';
}

// Check email
function ValidateEmail($value)
{
$regex = '|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i';

if($value == '') {
return false;
} else {
$string = preg_replace($regex, '', $value);
}

return empty($string) ? true : false;
}

if(!$email)
{
$error .= 'Пожалуйста введите e-mail.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Введите корректный e-mail.<br />';
}

// Check message (length)

if(!$message || strlen($message) < 1)
{
$error .= "Введите ваше сообщение.<br />";// В этой строчке ставиться минимальное ограничение на написание букв.
}
if(!$error)
{
$body = 'Имя: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Тел.: ' . $phone . "\n\n" . 'Сообщение: ' . $message;

   $headers = "Content-type: text/plain; charset=\"utf-8\"\r\n"; 
   $headers .= "From: <". $email .">\r\n"; 
   $headers .= "MIME-Version: 1.0\r\n"; 
   $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n"; 

$mail = mail("remont@kvartiralike.ru", $subject, $body, $headers);
if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="status alert alert-danger">'.$error.'</div>';
}

}
?>