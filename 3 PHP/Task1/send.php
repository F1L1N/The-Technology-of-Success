<?php
/*$_POST['email'] = "pavel9696@yandex.ru";
$_POST['subject'] = "Hello";
$_POST['message'] = "Nice to meet you";
echo $_POST['email'].'lol';
echo $_POST['message'].'lol';
echo $_POST['subject'].'lol';*/
if (isset($_POST["email"]) && isset($_POST["message"]) && isset($_POST["subject"]))
{
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    $email = htmlspecialchars($email);
    $email = urldecode($email);
    $email = trim($email);

    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: Your name <info@address.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($email, $subject, $message, $headers);
}


