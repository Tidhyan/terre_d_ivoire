<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $sous_titre = $_POST['sous_titre'];
    $texte_bouton = $_POST['texte_bouton'];
    $lien_bouton = $_POST['lien_bouton'];
    $ordre = $_POST['ordre'];

    // Gestion de l'image
    $target_dir = "uploads/carrousel/";
    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
    
    $file_name = time() . '_' . basename($_FILES["image_carrousel"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["image_carrousel"]["tmp_name"], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO carrousel (image_url, titre, sous_titre, texte_bouton, lien_bouton, ordre) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$target_file, $titre, $sous_titre, $texte_bouton, $lien_bouton, $ordre]);
    }

    header("Location: admin_carrousel.php");
}