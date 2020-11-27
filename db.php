<?php

function getConn() {
    $host = 'localhost';
    $dbname = 'beelog_wp';
    $dbusername = 'root';
    $dbpassword = '';

    $connection = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    if (!$connection) {
        die('connection to db failed');
    }

    return $connection;
}

?>