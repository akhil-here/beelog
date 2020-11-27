<?php

include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id !== NULL) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}


?>