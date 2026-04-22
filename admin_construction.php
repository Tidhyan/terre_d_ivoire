<?php
session_start();
if(!isset($_SESSION['admin_logged'])){
    header('Location: admin.php');
    exit;
}
?>
<?php 
include('db.php'); 

// Suppression d'un projet
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // On pourrait ici ajouter la suppression des fichiers physiques dans /uploads
    $pdo->prepare("DELETE FROM modeles_construction WHERE id = ?")->execute([$id]);
    header("Location: admin_construction.php?status=deleted");
}

// Récupération des données pour modification
$edit_data = null;
if(isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM modeles_construction WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_data = $stmt->fetch();
}

// Liste de tous les projets
$projets = $pdo->query("SELECT * FROM modeles_construction ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head> 
    <meta charset="UTF-8">
    <title>Administration Construction | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">
</head>
<body class="bg-gray-100 p-4 md:p-8">
    <div class="max-w-5xl mx-auto space-y-10">
        <?php if(isset($_GET['status'])): ?>
            <div id="alert-msg" class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm transition-all duration-500">
                <div class="flex items-center gap-3">
                    <span class="text-xl">
                        <?php echo ($_GET['status'] == 'success') ? '✨' : '✅'; ?>
                    </span>
                    <div>
                        <span class="font-bold">
                            <?php echo ($_GET['status'] == 'success') ? 'Projet publié !' : 'Mise à jour réussie !'; ?>
                        </span> 
                        <p class="text-sm opacity-90">
                            <?php echo ($_GET['status'] == 'success') ? 'Le nouveau modèle de construction est maintenant en ligne.' : 'Les modifications ont été enregistrées.'; ?>
                        </p>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-2">✕</button>
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('alert-msg');
                    if (alert) {
                        alert.style.opacity = "0";
                        alert.style.transform = "translateY(-10px)";
                        setTimeout(() => alert.remove(), 600);
                    }
                }, 4000);
            </script>
        <?php endif; ?>
        <div class="bg-white p-8 shadow-md rounded">
            <h1 class="text-2xl font-bold mb-6 border-b pb-4">
                <a href="admin_dashboard.php" class="inline-flex items-center gap-2 bg-black text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#D4AF37] transition-all duration-300 shadow-lg text-sm">
    <span>←</span> Retour
</a>
                <?php echo $edit_data ? "Modifier : ".$edit_data['nom_modele'] : "Ajouter un Projet de Construction"; ?>
            </h1>
            
            <form action="save_construction.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php if($edit_data): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                <?php endif; ?>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Nom de la Villa</label>
                        <input type="text" name="nom_modele" value="<?php echo $edit_data['nom_modele'] ?? ''; ?>" class="w-full border p-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold">Slogan</label>
                        <input type="text" name="slogan" value="<?php echo $edit_data['slogan'] ?? ''; ?>" class="w-full border p-2">
                    </div>
                </div>

                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full border p-2" rows="3"><?php echo $edit_data['description'] ?? ''; ?></textarea>

                <label class="block font-semibold">Caractéristiques (séparez par des virgules)</label>
                <input type="text" name="caracteristiques" value="<?php echo $edit_data['caracteristiques'] ?? ''; ?>" class="w-full border p-2">

                <label class="block font-semibold">Prix (FCFA)</label>
                <input type="text" name="prix" value="<?php echo $edit_data['prix'] ?? ''; ?>" class="w-full border p-2">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Lien Vidéo (YouTube)</label>
                        <input type="url" name="lien_video" value="<?php echo $edit_data['lien_video'] ?? ''; ?>" class="w-full border p-2">
                    </div>
                    <div>
                        <label class="block font-semibold">Lien Matterport (VR)</label>
                        <input type="url" name="lien_matterport" value="<?php echo $edit_data['lien_matterport'] ?? ''; ?>" class="w-full border p-2">
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="font-bold mb-3 text-red-600">Photos du projet <?php if($edit_data) echo "(Laissez vide pour garder les anciennes)"; ?></h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold">Photo Principale 1</label>
                            <input type="file" name="photo1" class="w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-bold">Photo Principale 2</label>
                            <input type="file" name="photo2" class="w-full">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-bold">Slider 3D (Sélection multiple)</label>
                        <input type="file" name="slider_3d[]" multiple class="w-full border-2 border-dashed p-4">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-black text-white py-4 font-bold hover:bg-zinc-800 transition uppercase">
                        <?php echo $edit_data ? "Mettre à jour le projet" : "Publier le projet"; ?>
                    </button>
                    <?php if($edit_data): ?>
                        <a href="admin_construction.php" class="bg-gray-400 text-white px-6 py-4 font-bold hover:bg-gray-500">ANNULER</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="bg-white p-8 shadow-md rounded">
            <h2 class="text-xl font-bold mb-6 border-b pb-4">Projets en ligne</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-sm uppercase">
                            <th class="p-3">Aperçu</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Prix</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php foreach($projets as $p): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">
                                <img src="uploads/<?php echo $p['photo_principale_1']; ?>" class="w-16 h-12 object-cover rounded">
                            </td>
                            <td class="p-3 font-semibold"><?php echo $p['nom_modele']; ?></td>
                            <td class="p-3 text-sm"><?php echo $p['prix']; ?> FCFA</td>
                            <td class="p-3 space-x-2">
                                <a href="?edit=<?php echo $p['id']; ?>" class="text-blue-600 hover:underline text-sm font-bold uppercase">Modifier</a>
                                <a href="?delete=<?php echo $p['id']; ?>" onclick="return confirm('Supprimer ce projet définitivement ?')" class="text-red-600 hover:underline text-sm font-bold uppercase">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>