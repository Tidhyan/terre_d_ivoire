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
        if (file_exists("uploads/" . $img['photo_principale'])) {
            unlink("uploads/" . $img['photo_principale']);
        }
        $pdo->prepare("DELETE FROM produits_vente WHERE id = ?")->execute([$id_to_delete]);
        header("Location: admin_vente.php");
        exit();
    }
}

// --- LOGIQUE DE RÉCUPÉRATION ---
$bien_a_modifier = null;
if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM produits_vente WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $bien_a_modifier = $stmt->fetch();
}

$projets = $pdo->query("SELECT * FROM produits_vente ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Vente | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Style pour simuler des boutons radio avec des checkboxes */
        .delivery-checkbox:checked + label {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
    </style>
    
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">
</head>
<body class="bg-gray-100 p-4 md:p-8">
    <div class="max-w-5xl mx-auto space-y-10">
        <?php if(isset($_GET['status'])): ?>
        <div id="alert-msg" class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center justify-between shadow-sm transition-all duration-500">
            <div class="flex items-center gap-3">
                <span class="text-xl">
                    <?php echo ($_GET['status'] == 'success') ? '✨' : '✅'; ?>
                </span>
                <div>
                    <span class="font-bold">
                        <?php echo ($_GET['status'] == 'success') ? 'Bien ajouté !' : 'Mise à jour réussie !'; ?>
                    </span> 
                    <?php echo ($_GET['status'] == 'success') ? 'L’annonce est désormais visible sur le site.' : 'Les modifications ont été enregistrées.'; ?>
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
        <div class="bg-white p-8 shadow-sm rounded-xl border-t-4 <?php echo $bien_a_modifier ? 'border-blue-500' : 'border-black'; ?>">
            <h1 class="text-2xl font-bold mb-6 border-b pb-4 flex items-center gap-3">
                      <a href="admin_dashboard.php" class="inline-flex items-center gap-2 bg-black text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#D4AF37] transition-all duration-300 shadow-lg text-sm">
    <span>←</span> Retour
</a>
                <span><?php echo $bien_a_modifier ? '📝 Modifier le bien' : '🏗️ Ajouter un nouveau bien'; ?></span>
            </h1>
            
            <form action="<?php echo $bien_a_modifier ? 'update_vente.php' : 'save_vente.php'; ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <?php if($bien_a_modifier): ?>
                    <input type="hidden" name="id" value="<?php echo $bien_a_modifier['id']; ?>">
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Catégorie</label>
                        <select name="categorie" id="categorySelect" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none transition" required>
                            <option value="promotion" <?php echo ($bien_a_modifier && $bien_a_modifier['categorie'] == 'promotion') ? 'selected' : ''; ?>>🏗️ Promotion Immobilière</option>
                            <option value="particulier" <?php echo ($bien_a_modifier && $bien_a_modifier['categorie'] == 'particulier') ? 'selected' : ''; ?>>🏠 Propriété Particulière</option>
                            </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Nom du bien / Villa</label>
                        <input type="text" name="nom" value="<?php echo $bien_a_modifier ? htmlspecialchars($bien_a_modifier['nom']) : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none" placeholder="ex: Villa Akwaba" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Prix (FCFA)</label>
                        <input type="text" name="prix" value="<?php echo $bien_a_modifier ? $bien_a_modifier['prix'] : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg" placeholder="ex: 85.000.000">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Localisation</label>
                        <input type="text" name="localisation" value="<?php echo $bien_a_modifier ? $bien_a_modifier['localisation'] : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg" placeholder="ex: Assinie">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Surface (m²)</label>
                        <input type="text" name="superficie" value="<?php echo $bien_a_modifier ? $bien_a_modifier['superficie'] : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg" placeholder="ex: 500">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Nombre de Pièces</label>
                        <input type="text" name="pieces" value="<?php echo $bien_a_modifier ? $bien_a_modifier['pieces'] : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg" placeholder="ex: 6">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-lg border border-gray-100">
    <div>
        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Parking</label>
        <input type="number" name="parking" value="<?php echo $bien_a_modifier ? $bien_a_modifier['parking'] : ''; ?>" class="w-full border-2 border-white p-3 rounded-lg focus:border-black outline-none" placeholder="ex: 2">
    </div>
    
    <div>
        <label class="block font-bold text-xs uppercase text-gray-500 mb-2 text-orange-600">Vidéo YouTube (Lien)</label>
        <input type="url" name="video_youtube" value="<?php echo (isset($bien_a_modifier['video_youtube'])) ? $bien_a_modifier['video_youtube'] : ''; ?>" class="w-full border-2 border-white p-3 rounded-lg focus:border-orange-500 outline-none" placeholder="https://www.youtube.com/watch?v=...">
    </div>

    <div>
        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Visite 3D (Matterport)</label>
        <input type="url" name="lien_video" value="<?php echo (isset($bien_a_modifier['lien_video'])) ? $bien_a_modifier['lien_video'] : ''; ?>" class="w-full border-2 border-white p-3 rounded-lg focus:border-black outline-none" placeholder="Lien matterport existant">
    </div>
</div>

                <div class="space-y-4">
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Phrase d'accroche</label>
                        <input type="text" name="accroche" value="<?php echo $bien_a_modifier ? htmlspecialchars($bien_a_modifier['accroche']) : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none" placeholder="ex: Un écrin de Modernité au cœur d'Assinie">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Description complète</label>
                        <textarea name="description" class="w-full border-2 border-gray-100 p-3 rounded-lg h-32"><?php echo $bien_a_modifier ? htmlspecialchars($bien_a_modifier['description']) : ''; ?></textarea>
                    </div>
                </div>

                <div id="deliverySection" class="p-6 border-2 border-dashed border-gray-200 rounded-xl">
                    <label class="block font-bold text-xs uppercase text-gray-500 mb-4 text-center">Option de livraison (une seule possible)</label>
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <div class="relative">
                            <input type="checkbox" id="gros_oeuvre" name="livraison_gros_oeuvre" value="1" 
                                   class="hidden delivery-checkbox" 
                                   onclick="handleDeliverySelection('gros_oeuvre')"
                                   <?php echo ($bien_a_modifier && $bien_a_modifier['livraison_gros_oeuvre']) ? 'checked' : ''; ?>>
                            <label for="gros_oeuvre" class="cursor-pointer border-2 border-gray-200 px-8 py-3 block rounded-full font-bold transition text-sm">🏗️ GROS ŒUVRE</label>
                        </div>
                        <div class="relative">
                            <input type="checkbox" id="cle_main" name="livraison_cle_main" value="1" 
                                   class="hidden delivery-checkbox" 
                                   onclick="handleDeliverySelection('cle_main')"
                                   <?php echo ($bien_a_modifier && $bien_a_modifier['livraison_cle_main']) ? 'checked' : ''; ?>>
                            <label for="cle_main" class="cursor-pointer border-2 border-gray-200 px-8 py-3 block rounded-full font-bold transition text-sm">✨ CLÉ EN MAIN</label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Photo Principale <?php echo $bien_a_modifier ? '(Optionnel)' : ''; ?></label>
                        <input type="file" name="photo_principale" class="w-full" <?php echo $bien_a_modifier ? '' : 'required'; ?>>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Galerie Photos</label>
                        <input type="file" name="galerie[]" multiple class="w-full">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 <?php echo $bien_a_modifier ? 'bg-blue-600' : 'bg-black'; ?> text-white py-5 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase tracking-widest text-sm">
                        <?php echo $bien_a_modifier ? '💾 Enregistrer les modifications' : '🚀 Enregistrer le bien sur le site'; ?>
                    </button>
                    
                    <?php if($bien_a_modifier): ?>
                        <a href="admin_vente.php" class="bg-gray-200 text-gray-600 py-5 px-8 rounded-xl font-bold uppercase text-sm flex items-center">Annuler</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <div class="bg-white p-8 shadow-sm rounded-xl">
            <h2 class="text-xl font-bold mb-6">Gestion des annonces</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-widest border-b">
                            <th class="pb-4">Bien</th>
                            <th class="pb-4">Catégorie</th>
                            <th class="pb-4">Accroche</th>
                            <th class="pb-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach($projets as $p): ?>
                        <tr class="group hover:bg-gray-50 transition">
                            <td class="py-4">
                                <div class="flex items-center gap-4">
                                    <img src="uploads/<?php echo $p['photo_principale']; ?>" class="w-12 h-12 object-cover rounded-lg">
                                    <span class="font-semibold text-gray-800"><?php echo htmlspecialchars($p['nom']); ?></span>
                                </div>
                            </td>
                            <td class="py-4 text-xs uppercase font-bold text-gray-500"><?php echo $p['categorie']; ?></td>
                            <td class="py-4 text-xs italic text-gray-400"><?php echo substr($p['accroche'], 0, 40); ?>...</td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="admin_vente.php?edit_id=<?php echo $p['id']; ?>" class="text-blue-600 text-xs font-bold hover:underline">MODIFIER</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="admin_vente.php?delete_id=<?php echo $p['id']; ?>" onclick="return confirm('Supprimer définitivement ?')" class="text-red-500 text-xs font-bold hover:underline">SUPPRIMER</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Logique pour désélectionner l'autre option de livraison
        function handleDeliverySelection(id) {
            const grosOeuvre = document.getElementById('gros_oeuvre');
            const cleMain = document.getElementById('cle_main');

            if (id === 'gros_oeuvre' && grosOeuvre.checked) {
                cleMain.checked = false;
            } else if (id === 'cle_main' && cleMain.checked) {
                grosOeuvre.checked = false;
            }
        }
    </script>
</body>
</html>