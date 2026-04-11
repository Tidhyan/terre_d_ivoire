<?php
include('db.php');

// Récupération des données simples
$cat = $_POST['categorie'];
$nom = $_POST['nom'];
$accroche = $_POST['accroche'];
$loc = $_POST['localisation'];
$desc = $_POST['description'];
$prix = $_POST['prix'];
$sup = $_POST['superficie'];
$pieces = $_POST['pieces']; 
$parking = $_POST['parking'];
$video = $_POST['lien_video']; // Utilisé pour Terrain (YouTube)
$matterport = $_POST['matterport']; // Utilisé pour Villas (Lien 3D)

// Gestion des options de livraison (Checkboxes : 1 si coché, 0 sinon)
$livraison_gros = isset($_POST['livraison_gros_oeuvre']) ? 1 : 0;
$livraison_cle = isset($_POST['livraison_cle_main']) ? 1 : 0;

// Si c'est une villa, on utilise le lien Matterport comme lien_video principal
$video_final = ($cat === 'terrain') ? $video : $matterport;

$carac = $_POST['caracteristiques'] ?? '';

// Gestion de la Photo principale
$photo_p = time() . '_' . $_FILES['photo_principale']['name'];
move_uploaded_file($_FILES['photo_principale']['tmp_name'], 'uploads/' . $photo_p);

// REQUÊTE SQL COMPLÈTE
$sql = "INSERT INTO produits_vente (
            categorie, nom, accroche, localisation, description, prix, 
            superficie, pieces, parking, lien_video, caracteristiques, 
            livraison_gros_oeuvre, livraison_cle_main, photo_principale
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $cat, $nom, $accroche, $loc, $desc, $prix, 
    $sup, $pieces, $parking, $video_final, $carac, 
    $livraison_gros, $livraison_cle, $photo_p
]);

$id_produit = $pdo->lastInsertId();

// Galerie Photos
if (!empty($_FILES['galerie']['name'][0])) {
    foreach ($_FILES['galerie']['tmp_name'] as $key => $tmp_name) {
        $filename = time() . '_gal_' . $_FILES['galerie']['name'][$key];
        if (move_uploaded_file($tmp_name, 'uploads/' . $filename)) {
            $pdo->prepare("INSERT INTO photos_vente_galerie (id_produit, chemin_image) VALUES (?, ?)")
                ->execute([$id_produit, $filename]);
        }
    }
}

header("Location: admin_vente.php?success=1");
exit();
?>