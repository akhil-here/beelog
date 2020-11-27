<?php

include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id !== NULL) {
    $auth->logout();
    header("Location: login.php");
}


?>