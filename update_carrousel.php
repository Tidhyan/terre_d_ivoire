<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $sous_titre = $_POST['sous_titre'];
    $texte_bouton = $_POST['texte_bouton'];
    $lien_bouton = $_POST['lien_bouton'];
    $ordre = $_POST['ordre'];

    // 1. On récupère l'ancienne image au cas où on doive la remplacer
    $stmt = $pdo->prepare("SELECT image_url FROM carrousel WHERE id = ?");
    $stmt->execute([$id]);
    $old_data = $stmt->fetch();
    $image_url = $old_data['image_url'];

    // 2. Gestion de la nouvelle image (si une photo est téléchargée)
    if (!empty($_FILES['image_carrousel']['name'])) {
        $target_dir = "uploads/carrousel/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

        $file_name = time() . '_' . basename($_FILES["image_carrousel"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image_carrousel"]["tmp_name"], $target_file)) {
            // On supprime l'ancienne image du serveur pour faire de la place
            if (file_exists($image_url)) {
                unlink($image_url);
            }
            $image_url = $target_file;
        }
    }

    // 3. Mise à jour de la base de données
    $sql = "UPDATE carrousel SET 
            image_url = ?, 
            titre = ?, 
            sous_titre = ?, 
            texte_bouton = ?, 
            lien_bouton = ?, 
            ordre = ? 
            WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$image_url, $titre, $sous_titre, $texte_bouton, $lien_bouton, $ordre, $id]);

    // Redirection vers la page de gestion avec un petit paramètre de succès si tu veux
    header("Location: admin_carrousel.php?status=updated");
    exit();
}