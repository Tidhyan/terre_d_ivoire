<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $categorie = $_POST['categorie'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $localisation = $_POST['localisation'];
    $superficie = $_POST['superficie'];
    $pieces = $_POST['pieces'];
    $accroche = $_POST['accroche'];
    $description = $_POST['description'];

    try {
        // J'ai retiré 'matterport', 'lien_video' et les livraisons de la requête
        $sql = "UPDATE produits_vente SET 
                categorie = ?, nom = ?, prix = ?, localisation = ?, 
                superficie = ?, pieces = ?, accroche = ?, description = ? 
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $categorie, $nom, $prix, $localisation, 
            $superficie, $pieces, $accroche, $description, $id
        ]);

        // Gestion de la photo principale (si changée)
        if (!empty($_FILES['photo_principale']['name'])) {
            $nom_photo = time() . '_' . $_FILES['photo_principale']['name'];
            if (move_uploaded_file($_FILES['photo_principale']['tmp_name'], "uploads/" . $nom_photo)) {
                $pdo->prepare("UPDATE produits_vente SET photo_principale = ? WHERE id = ?")->execute([$nom_photo, $id]);
            }
        }

        header("Location: admin_vente.php?status=updated");
        exit();

    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour : " . $e->getMessage());
    }
}