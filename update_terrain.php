<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_logged'])) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $superficie = $_POST['superficie'];
    $localisation = $_POST['localisation'];
    $statut = $_POST['statut'];
    $lien_video = $_POST['lien_video'];
    $description = $_POST['description'];

    // 1. Récupérer l'ancienne photo pour la conserver ou la supprimer
    $stmt = $pdo->prepare("SELECT photo_principale FROM produits_vente WHERE id = ?");
    $stmt->execute([$id]);
    $old_data = $stmt->fetch();
    $photo_nom = $old_data['photo_principale'];

    // 2. Gestion de la nouvelle photo (si téléchargée)
    if (!empty($_FILES['photo_principale']['name'])) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["photo_principale"]["name"], PATHINFO_EXTENSION);
        $new_file_name = time() . "_terrain." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        if (move_uploaded_file($_FILES["photo_principale"]["tmp_name"], $target_file)) {
            // Supprimer l'ancienne photo du serveur pour libérer de l'espace
            if (!empty($photo_nom) && file_exists($target_dir . $photo_nom)) {
                unlink($target_dir . $photo_nom);
            }
            $photo_nom = $new_file_name;
        }
    }

    // 3. Mise à jour de la base de données
    $sql = "UPDATE produits_vente SET 
            nom = ?, 
            prix = ?, 
            superficie = ?, 
            localisation = ?, 
            statut = ?, 
            lien_video = ?, 
            description = ?, 
            photo_principale = ? 
            WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nom, 
        $prix, 
        $superficie, 
        $localisation, 
        $statut, 
        $lien_video, 
        $description, 
        $photo_nom, 
        $id
    ]);

    // Redirection ciblée vers la page terrain
    header("Location: admin_terrain.php?status=updated");
    exit();
}