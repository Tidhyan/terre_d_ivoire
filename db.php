<?php
// Paramètres reçus de l'hébergeur
$host = '127.0.0.1'; // L'hébergeur précise d'utiliser ça au lieu de localhost
$dbname = 'terre2778259';
$user = 'terre2778259';
$pass = 'jm641urfs5';

try {
    // Connexion avec les nouveaux identifiants
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    
    // Activation des erreurs pour t'aider si une requête SQL plante
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // En production, on affiche un message propre
    // Mais si tu as encore une erreur, remplace temporairement par : die($e->getMessage());
    die("Une erreur de connexion est survenue. Veuillez réessayer plus tard.");
}
?>
