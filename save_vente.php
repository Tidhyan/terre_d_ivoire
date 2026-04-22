<?php
include('db.php');

// 1. Récupération des données du formulaire
$cat = $_POST['categorie'];
$nom = $_POST['nom'];
$accroche = $_POST['accroche'];
$loc = $_POST['localisation'];
$desc = $_POST['description'];
$prix = $_POST['prix'];
$sup = $_POST['superficie'];
$pieces = $_POST['pieces']; 
$parking = $_POST['parking'];

// On récupère les deux liens distincts
$video_youtube = $_POST['video_youtube']; // Le nouveau champ YouTube
$matterport = $_POST['lien_video'];    // Le champ Matterport (nommé lien_video dans le formulaire)

// Gestion des options de livraison
$livraison_gros = isset($_POST['livraison_gros_oeuvre']) ? 1 : 0;
$livraison_cle = isset($_POST['livraison_cle_main']) ? 1 : 0;

$carac = $_POST['caracteristiques'] ?? '';

// 2. Gestion de la Photo principale
$photo_p = "";
if(isset($_FILES['photo_principale']) && $_FILES['photo_principale']['error'] == 0){
    $photo_p = time() . '_' . $_FILES['photo_principale']['name'];
    move_uploaded_file($_FILES['photo_principale']['tmp_name'], 'uploads/' . $photo_p);
}

// 3. REQUÊTE SQL (Correction du nombre de ?)
// Il y a 15 colonnes, il faut donc exactement 15 points d'interrogation
$sql = "INSERT INTO produits_vente (
            categorie, nom, accroche, localisation, description, prix, 
            superficie, pieces, parking, video_youtube, lien_video, caracteristiques, 
            livraison_gros_oeuvre, livraison_cle_main, photo_principale
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

// 4. EXÉCUTION (L'ordre doit être strictement le même que dans la liste au-dessus)
$stmt->execute([
    $cat,             // 1
    $nom,             // 2
    $accroche,        // 3
    $loc,             // 4
    $desc,            // 5
    $prix,            // 6
    $sup,             // 7
    $pieces,          // 8
    $parking,         // 9
    $video_youtube,   // 10 (Nouvelle colonne)
    $matterport,      // 11 (Colonne lien_video)
    $carac,           // 12
    $livraison_gros,  // 13
    $livraison_cle,   // 14
    $photo_p          // 15
]);

$id_produit = $pdo->lastInsertId();

// 5. Gestion de la Galerie Photos
if (!empty($_FILES['galerie']['name'][0])) {
    foreach ($_FILES['galerie']['tmp_name'] as $key => $tmp_name) {
        if($_FILES['galerie']['error'][$key] == 0){
            $filename = time() . '_gal_' . $_FILES['galerie']['name'][$key];
            if (move_uploaded_file($tmp_name, 'uploads/' . $filename)) {
                $pdo->prepare("INSERT INTO photos_vente_galerie (id_produit, chemin_image) VALUES (?, ?)")
                    ->execute([$id_produit, $filename]);
            }
        }
    }
}

header("Location: admin_vente.php?status=success");
exit();
?>