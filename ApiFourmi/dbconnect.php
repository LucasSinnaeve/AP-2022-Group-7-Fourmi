<?php
$host = "localhost";
$namedb = "bddmission";
$login = "root";
$mdp = "root";

try {
    $db = new  PDO("mysql:host=$host;dbname=$namedb", $login, $mdp);
}catch (PDOException $e){
    echo $e->getMessage();
    die();
}