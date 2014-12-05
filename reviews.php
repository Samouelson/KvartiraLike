<?php

$post = (!empty($_POST)) ? true : false;

if($post)
{
$subject = 'Отзыв клиента';
$email = trim($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$address = htmlspecialchars($_POST['address']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$error = '';

if(!$name)
{
$error .= 'Пожалуйста, введите имя<br />';
}

if(!$address)
{
$error .= 'Пожалуйста, введите адрес ремонта<br />';
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
$error .= 'Пожалуйста, введите e-mail<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Введите правильный e-mail<br />';
}

// Check message (length)

if(!$message || strlen($message) < 1)
{
$error .= "Введите ваше сообщение.<br />";// В этой строчке ставиться минимальное ограничение на написание букв.
}
if(!$error)
{
$body = 'Имя: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Сообщение: ' . $message  . "\n\n" . 'Адрес: ' . $address;

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