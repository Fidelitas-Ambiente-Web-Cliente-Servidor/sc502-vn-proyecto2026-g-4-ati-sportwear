<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "ati_sportwear";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error de conexión");
}

?>
