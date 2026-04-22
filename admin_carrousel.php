<?php
session_start();
if(!isset($_SESSION['admin_logged'])){
    header('Location: admin.php');
    exit;
}
include('db.php'); 

// --- LOGIQUE DE SUPPRESSION ---
if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $stmt = $pdo->prepare("SELECT image_url FROM carrousel WHERE id = ?");
    $stmt->execute([$id_to_delete]);
    $img = $stmt->fetch();

    if ($img) {
        if (file_exists($img['image_url'])) {
            unlink($img['image_url']);
        }
        $pdo->prepare("DELETE FROM carrousel WHERE id = ?")->execute([$id_to_delete]);
        header("Location: admin_carrousel.php");
        exit();
    }
}

// --- LOGIQUE DE RÉCUPÉRATION POUR MODIFICATION ---
$slide_a_modifier = null;
if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM carrousel WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $slide_a_modifier = $stmt->fetch();
}

$slides = $pdo->query("SELECT * FROM carrousel ORDER BY ordre ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Carrousel | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-gray-100 p-4 md:p-8">

    <?php if(isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
        ✅ La slide a été mise à jour avec succès !
    </div>
<?php endif; ?>


    <div class="max-w-5xl mx-auto space-y-10">
        
        <div class="bg-white p-8 shadow-sm rounded-xl border-t-4 <?php echo $slide_a_modifier ? 'border-blue-500' : 'border-black'; ?>">
            <h1 class="text-2xl font-bold mb-6 border-b pb-4 flex items-center gap-3">
                <a href="admin_dashboard.php" class="inline-flex items-center gap-2 bg-black text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#D4AF37] transition-all duration-300 shadow-lg text-sm">
                    <span>←</span> Retour
                </a>
                <span><?php echo $slide_a_modifier ? '📝 Modifier la Slide' : '🖼️ Ajouter une Slide au Carrousel'; ?></span>
            </h1>
            
            <form action="<?php echo $slide_a_modifier ? 'update_carrousel.php' : 'save_carrousel.php'; ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <?php if($slide_a_modifier): ?>
                    <input type="hidden" name="id" value="<?php echo $slide_a_modifier['id']; ?>">
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Titre de la Slide (HTML autorisé pour les &lt;br&gt;)</label>
                        <input type="text" name="titre" value="<?php echo $slide_a_modifier ? htmlspecialchars($slide_a_modifier['titre']) : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none" placeholder="ex: Construire, vendre et valoriser <span>autrement</span>" required>
                    </div>
                    
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Sous-titre (L'accroche du haut)</label>
                        <input type="text" name="sous_titre" value="<?php echo $slide_a_modifier ? htmlspecialchars($slide_a_modifier['sous_titre']) : ''; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none" placeholder="ex: L'IMMOBILIER DE PRESTIGE">
                    </div>

                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Ordre d'apparition</label>
                        <input type="number" name="ordre" value="<?php echo $slide_a_modifier ? $slide_a_modifier['ordre'] : '0'; ?>" class="w-full border-2 border-gray-100 p-3 rounded-lg focus:border-black outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Texte du bouton</label>
                        <input type="text" name="texte_bouton" value="<?php echo $slide_a_modifier ? htmlspecialchars($slide_a_modifier['texte_bouton']) : 'VOIR LES BIENS'; ?>" class="w-full border-2 border-white p-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase text-gray-500 mb-2">Lien du bouton</label>
                        <input type="text" name="lien_bouton" value="<?php echo $slide_a_modifier ? htmlspecialchars($slide_a_modifier['lien_bouton']) : '#'; ?>" class="w-full border-2 border-white p-3 rounded-lg" placeholder="ex: #vente ou https://...">
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Image de fond (Recommandé : 1920x1080px)</label>
                    <input type="file" name="image_carrousel" class="w-full" <?php echo $slide_a_modifier ? '' : 'required'; ?>>
                    <?php if($slide_a_modifier): ?>
                        <p class="text-xs text-blue-500 mt-2 italic">Laissez vide pour conserver l'image actuelle.</p>
                    <?php endif; ?>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 <?php echo $slide_a_modifier ? 'bg-blue-600' : 'bg-black'; ?> text-white py-5 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase tracking-widest text-sm">
                        <?php echo $slide_a_modifier ? '💾 Mettre à jour la slide' : '🚀 Publier la slide'; ?>
                    </button>
                    <?php if($slide_a_modifier): ?>
                        <a href="admin_carrousel.php" class="bg-gray-200 text-gray-600 py-5 px-8 rounded-xl font-bold uppercase text-sm flex items-center">Annuler</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <div class="bg-white p-8 shadow-sm rounded-xl">
            <h2 class="text-xl font-bold mb-6">Slides actives</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-widest border-b">
                            <th class="pb-4">Visuel</th>
                            <th class="pb-4">Titres</th>
                            <th class="pb-4 text-center">Ordre</th>
                            <th class="pb-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach($slides as $s): ?>
                        <tr class="group hover:bg-gray-50 transition">
                            <td class="py-4">
                                <img src="<?php echo $s['image_url']; ?>" class="w-20 h-12 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="py-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-gray-400 uppercase"><?php echo htmlspecialchars($s['sous_titre']); ?></span>
                                    <span class="font-semibold text-gray-800 text-sm"><?php echo strip_tags($s['titre']); ?></span>
                                </div>
                            </td>
                            <td class="py-4 text-center font-bold text-gray-600"><?php echo $s['ordre']; ?></td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="admin_carrousel.php?edit_id=<?php echo $s['id']; ?>" class="text-blue-600 text-xs font-bold hover:underline">MODIFIER</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="admin_carrousel.php?delete_id=<?php echo $s['id']; ?>" onclick="return confirm('Supprimer cette slide ?')" class="text-red-500 text-xs font-bold hover:underline">SUPPRIMER</a>
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
    // Fait disparaître l'alerte doucement après 3 secondes
    setTimeout(() => {
        const alert = document.querySelector('.bg-green-100');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>


</body>
</html>