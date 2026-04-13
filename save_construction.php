<?php
include('db.php');

// 1. Récupération des données textes
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nom = $_POST['nom_modele'];
$slogan = $_POST['slogan'];
$desc = $_POST['description'];
$carac = $_POST['caracteristiques'];
$prix = $_POST['prix'];
$video = $_POST['lien_video'];
$matterport = $_POST['lien_matterport'];

if ($id) {
    // --- MODE MODIFICATION (UPDATE) ---
    
    // On récupère d'abord les anciennes données pour garder les photos si on n'en charge pas de nouvelles
    $stmt = $pdo->prepare("SELECT photo_principale_1, photo_principale_2 FROM modeles_construction WHERE id = ?");
    $stmt->execute([$id]);
    $ancien = $stmt->fetch();

    // Gestion photo 1
    if (!empty($_FILES['photo1']['name'])) {
        $photo1 = time() . '_1_' . $_FILES['photo1']['name'];
        move_uploaded_file($_FILES['photo1']['tmp_name'], 'uploads/' . $photo1);
    } else {
        $photo1 = $ancien['photo_principale_1']; // On garde l'ancienne
    }

    // Gestion photo 2
    if (!empty($_FILES['photo2']['name'])) {
        $photo2 = time() . '_2_' . $_FILES['photo2']['name'];
        move_uploaded_file($_FILES['photo2']['tmp_name'], 'uploads/' . $photo2);
    } else {
        $photo2 = $ancien['photo_principale_2']; // On garde l'ancienne
    }

    // UPDATE de la table principale
    $sql = "UPDATE modeles_construction SET 
            nom_modele = ?, slogan = ?, description = ?, caracteristiques = ?, 
            prix = ?, lien_video = ?, lien_matterport = ?, 
            photo_principale_1 = ?, photo_principale_2 = ? 
            WHERE id = ?";
    $pdo->prepare($sql)->execute([$nom, $slogan, $desc, $carac, $prix, $video, $matterport, $photo1, $photo2, $id]);

    // Gestion du slider 3D (Seulement si de nouvelles photos sont envoyées)
    if (!empty($_FILES['slider_3d']['name'][0])) {
        // Optionnel : Supprimer les anciennes photos 3D de la base si on veut tout remplacer
        $pdo->prepare("DELETE FROM photos_3d WHERE id_modele = ?")->execute([$id]);
        
        foreach ($_FILES['slider_3d']['tmp_name'] as $key => $tmp_name) {
            $filename = time() . '_3d_' . $_FILES['slider_3d']['name'][$key];
            if (move_uploaded_file($tmp_name, 'uploads/' . $filename)) {
                $pdo->prepare("INSERT INTO photos_3d (id_modele, chemin_image) VALUES (?, ?)")->execute([$id, $filename]);
            }
        }
    }

} else {
    // --- MODE NOUVELLE PUBLICATION (INSERT) ---
    
    $photo1 = time() . '_1_' . $_FILES['photo1']['name'];
    $photo2 = time() . '_2_' . $_FILES['photo2']['name'];
    move_uploaded_file($_FILES['photo1']['tmp_name'], 'uploads/' . $photo1);
    move_uploaded_file($_FILES['photo2']['tmp_name'], 'uploads/' . $photo2);

    $sql = "INSERT INTO modeles_construction (nom_modele, slogan, description, caracteristiques, prix, lien_video, lien_matterport, photo_principale_1, photo_principale_2) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([$nom, $slogan, $desc, $carac, $prix, $video, $matterport, $photo1, $photo2]);
    
    $new_id = $pdo->lastInsertId();

    // Insertion des photos 3D
    if (!empty($_FILES['slider_3d']['name'][0])) {
        foreach ($_FILES['slider_3d']['tmp_name'] as $key => $tmp_name) {
            $filename = time() . '_3d_' . $_FILES['slider_3d']['name'][$key];
            if (move_uploaded_file($tmp_name, 'uploads/' . $filename)) {
                $pdo->prepare("INSERT INTO photos_3d (id_modele, chemin_image) VALUES (?, ?)")->execute([$new_id, $filename]);
            }
        }
    }
}

if ($id) {
    // Si c'est une modification
    header("Location: admin_construction.php?status=updated");
} else {
    // Si c'est un nouvel ajout
    header("Location: admin_construction.php?status=success");
}
exit();
?>
?>