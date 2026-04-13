<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_logged'])) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    // Nettoyage du prix (on enlève les espaces pour la BDD)
    $prix = preg_replace('/[^0-9]/', '', $_POST['prix']);
    $superficie = $_POST['superficie'];
    $localisation = $_POST['localisation'];
    $statut = $_POST['statut'];
    $lien_video = $_POST['lien_video'];
    $description = $_POST['description'];
    $categorie = 'terrain'; // Forcé puisque c'est le script terrain

    // Gestion de l'image
    $photo_nom = "";
    if (!empty($_FILES['photo_principale']['name'])) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["photo_principale"]["name"], PATHINFO_EXTENSION);
        $photo_nom = time() . "_new_terrain." . $file_extension;
        move_uploaded_file($_FILES["photo_principale"]["tmp_name"], $target_dir . $photo_nom);
    }

    $sql = "INSERT INTO produits_vente (nom, prix, superficie, localisation, statut, lien_video, description, photo_principale, categorie) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prix, $superficie, $localisation, $statut, $lien_video, $description, $photo_nom, $categorie]);

    // Redirection avec un nouveau statut "success"
    header("Location: admin_terrain.php?status=success");
    exit();
}