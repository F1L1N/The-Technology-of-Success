<?php
if (isset($_POST["email"]))
{
    echo check($_POST["email"]);
}

function check($email)
{
    return (bool)(preg_match("/\A[^@]+@([^@\.]+\.)+[^@\.]+\z/", $email));
}