<?php
session_start();
if(!isset($_SESSION['admin_logged'])){
    header('Location: admin.php');
    exit;
}
?>
<?php 
include('db.php'); 

// --- LOGIQUE DE SUPPRESSION ---
if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $stmt = $pdo->prepare("SELECT photo_principale FROM produits_vente WHERE id = ?");
    $stmt->execute([$id_to_delete]);
    $img = $stmt->fetch();

    if ($img) {
        if (!empty($img['photo_principale']) && file_exists("uploads/" . $img['photo_principale'])) {
            unlink("uploads/" . $img['photo_principale']);
        }
        $pdo->prepare("DELETE FROM produits_vente WHERE id = ?")->execute([$id_to_delete]);
        header("Location: admin_terrain.php");
        exit();
    }
}

// --- LOGIQUE DE RÉCUPÉRATION POUR MODIFICATION ---
$t_mod = null;
if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM produits_vente WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $t_mod = $stmt->fetch();
}

// Récupération de la liste des terrains uniquement
$terrains = $pdo->query("SELECT * FROM produits_vente WHERE categorie = 'terrain' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Gestion Foncière | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
</head>
<body class="bg-gray-50 p-4 md:p-10">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-zinc-900">Gestion des <span class="text-orange-600">Terrains</span></h1>
            <a href="index.php" class="text-sm font-bold border-b-2 border-black">Voir le site</a>
            <a href="admin_dashboard.php" class="text-sm font-bold border-b-2 border-black">Retour</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 sticky top-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <?php echo $t_mod ? '📝 Modifier le terrain' : '✨ Nouveau Terrain'; ?>
                    </h2>

                    <form action="<?php echo $t_mod ? 'update_vente.php' : 'save_vente.php'; ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                        
                        <?php if($t_mod): ?>
                            <input type="hidden" name="id" value="<?php echo $t_mod['id']; ?>">
                        <?php endif; ?>
                        
                        <input type="hidden" name="categorie" value="terrain">

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Nom du terrain / Site</label>
                            <input type="text" name="nom" value="<?php echo $t_mod ? htmlspecialchars($t_mod['nom']) : ''; ?>" class="w-full bg-zinc-50 border-none p-3 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none" placeholder="ex: Lotissement Horizon" required>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Prix (FCFA)</label>
                                <input type="number" name="prix" value="<?php echo $t_mod ? $t_mod['prix'] : ''; ?>" class="w-full bg-zinc-50 border-none p-3 rounded-lg outline-none" placeholder="15000000">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Surface (m²)</label>
                                <input type="text" name="superficie" value="<?php echo $t_mod ? $t_mod['superficie'] : ''; ?>" class="w-full bg-zinc-50 border-none p-3 rounded-lg outline-none" placeholder="500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Localisation</label>
                            <input type="text" name="localisation" value="<?php echo $t_mod ? $t_mod['localisation'] : ''; ?>" class="w-full bg-zinc-50 border-none p-3 rounded-lg outline-none" placeholder="ex: Angré 7e Tranche">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Statut</label>
                            <select name="statut" class="w-full bg-zinc-50 border-none p-3 rounded-lg outline-none">
                                <option value="Disponible" <?php echo ($t_mod && $t_mod['statut'] == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                                <option value="Sous Compromis" <?php echo ($t_mod && $t_mod['statut'] == 'Sous Compromis') ? 'selected' : ''; ?>>Sous Compromis</option>
                                <option value="Vendu" <?php echo ($t_mod && $t_mod['statut'] == 'Vendu') ? 'selected' : ''; ?>>Vendu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Lien Vidéo (YouTube/Drive)</label>
                            <input type="url" name="lien_video" value="<?php echo $t_mod ? $t_mod['lien_video'] : ''; ?>" class="w-full bg-zinc-50 border-none p-3 rounded-lg outline-none" placeholder="https://...">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Description</label>
                            <textarea name="description" class="w-full bg-zinc-50 border-none p-3 rounded-lg h-24 outline-none"><?php echo $t_mod ? htmlspecialchars($t_mod['description']) : ''; ?></textarea>
                        </div>

                        <div class="bg-orange-50 p-3 rounded-lg border border-orange-100">
                            <label class="block text-[10px] font-bold uppercase text-orange-600 mb-1">Photo Principale</label>
                            <input type="file" name="photo_principale" class="text-xs">
                        </div>

                        <button type="submit" class="w-full bg-zinc-900 text-white py-4 rounded-xl font-bold hover:bg-orange-600 transition shadow-lg text-sm uppercase tracking-widest">
                            <?php echo $t_mod ? 'Enregistrer les modifications' : 'Publier le terrain'; ?>
                        </button>

                        <?php if($t_mod): ?>
                            <a href="admin_terrain.php" class="block text-center text-xs text-zinc-400 font-bold uppercase py-2">Annuler la modification</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-zinc-900 text-white">
                            <tr class="text-[10px] uppercase tracking-widest">
                                <th class="p-4">Visuel</th>
                                <th class="p-4">Terrain / Prix</th>
                                <th class="p-4">Localisation</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            <?php foreach($terrains as $t): ?>
                            <tr class="hover:bg-zinc-50 transition">
                                <td class="p-4">
                                    <img src="uploads/<?php echo $t['photo_principale']; ?>" class="w-16 h-12 object-cover rounded-md shadow-sm">
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-zinc-800"><?php echo htmlspecialchars($t['nom']); ?></p>
                                    <p class="text-orange-600 text-xs font-bold"><?php echo number_format((float)$t['prix'], 0, ',', ' '); ?> FCFA</p>
                                </td>
                                <td class="p-4 text-xs font-semibold text-zinc-500 italic">
                                    <?php echo htmlspecialchars($t['localisation']); ?>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="admin_terrain.php?edit_id=<?php echo $t['id']; ?>" class="bg-zinc-100 p-2 rounded-lg text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        <a href="admin_terrain.php?delete_id=<?php echo $t['id']; ?>" onclick="return confirm('Supprimer ce terrain ?')" class="bg-zinc-100 p-2 rounded-lg text-red-600 hover:bg-red-600 hover:text-white transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if(empty($terrains)): ?>
                        <div class="p-10 text-center text-zinc-400 italic">Aucun terrain en ligne.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>