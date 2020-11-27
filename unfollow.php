<?php
include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header('Location: login.php');
}

$userid = $_GET['id'];
$sql = "delete from follow where (p1 = '".$id."') and (p2 = '".$userid."')";

getConn()->query($sql);


header('Location: anon_profile.php?id='.$userid.'');

?>