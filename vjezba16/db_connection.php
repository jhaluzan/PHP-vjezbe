<?php
$host = '127.0.0.1';
$user = 'root'; 
$password = ''; 
$dbname = 'baza';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Povezivanje na bazu nije uspjelo: " . $conn->connect_error);
}
?>