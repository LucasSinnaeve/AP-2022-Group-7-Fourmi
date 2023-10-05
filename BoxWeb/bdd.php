<?php

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "bddmission";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Vérification de la connexion
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
