<?php

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

    if (mail($email, $subject, $message, $headers))
    {
        echo "Submission successful.";
    }
    else
    {
        echo "Submission failed.";
    }
}


