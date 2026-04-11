<?php
$host = 'localhost';
$dbname = 'terre_divoire';
$user = 'root';
$pass = ''; // Vide par défaut sur Windows

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>