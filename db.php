<?php
// 1. L'hôte est souvent 'localhost', mais parfois c'est une adresse IP ou un nom spécifique fourni par l'hébergeur
$host = 'localhost'; 

// 2. Le nom de la base de données (ton nouveau nom)
$dbname = 'terre2778259';

// 3. L'utilisateur (Sur un vrai serveur, ce n'est JAMAIS 'root')
// C'est souvent quelque chose comme 'u2778259_admin'
$user = 'terre2778259'; 

// 4. Le mot de passe (Celui que tu as créé lors de la création de la BDD sur ton hébergement)
$pass = '1jw1rfugaw'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Optionnel mais recommandé : Activer les erreurs en mode exception pour le développement
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En production, on évite d'afficher l'erreur brute pour la sécurité
    die("Une erreur de connexion est survenue. Veuillez réessayer plus tard.");
}
?>