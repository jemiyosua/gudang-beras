<?php

$servername = "localhost";
$database = "db_beras";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

// if (!$conn) {
//     echo 'database error';
//     exit;
// } else {
//     echo 'database oke';
//     exit;
// }