<?php
include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header('Location: login.php');
}

$userid = $_GET['userid'];
$sql = "replace into follow (p1,p2) values('".$id."','".$userid."')";

getConn()->query($sql);


header('Location: friend_profile.php?id='.$userid.'');

?>