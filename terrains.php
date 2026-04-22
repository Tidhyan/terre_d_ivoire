<?php 
include('db.php');

// 1. Récupérer toutes les localités uniques pour le menu déroulant
$stmtLoc = $pdo->query("SELECT DISTINCT localisation FROM produits_vente WHERE categorie = 'terrain'");
$localites = $stmtLoc->fetchAll(PDO::FETCH_COLUMN);

// 2. Initialiser la requête de base
$sql = "SELECT * FROM produits_vente WHERE categorie = 'terrain'";
$params = [];

// 3. Filtrer par localité
if (!empty($_GET['loc'])) {
    $sql .= " AND localisation = ?";
    $params[] = $_GET['loc'];
}

// 4. Filtrer par budget (Gestion des tranches)
if (!empty($_GET['budget']) && strpos($_GET['budget'], '-') !== false) {
    $tranche = explode('-', $_GET['budget']);
    $min = (int)trim($tranche[0]);
    $max = (int)trim($tranche[1]);
    
    // On force SQL à traiter la colonne 'prix' comme un nombre (CAST)
    $sql .= " AND CAST(prix AS UNSIGNED) BETWEEN ? AND ?";
    $params[] = $min;
    $params[] = $max;
}

// --- AJOUT CRUCIAL : L'exécution de la requête ---
$sql .= " ORDER BY id DESC";

$terrains = []; // Initialisation pour éviter l'erreur "Undefined variable"
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $terrains = $stmt->fetchAll();
} catch (Exception $e) {
    // Optionnel : error_log($e->getMessage());
    $terrains = []; 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terrains & Parcelles | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="couleur.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">
</head>
<body class="bg-white">

    <nav class="nav-glass fixed w-full z-50 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="index.php" class="flex items-center">
                <img src="images/logo.png" alt="Terre d'Ivoire Logo" 
                     style="height: 100px; width: auto; object-fit: contain; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.1));">
            </a>
            
            <div class="hidden md:flex items-center space-x-10 menu-links">
                <a href="index.php">ACCUEIL</a>
                
                <div class="relative group py-4">
                    <div class="flex items-center cursor-pointer">
                        <a href="catalogue.php" class="hover:text-gold transition-colors">VENTE</a>
                        <span class="ml-2 text-[10px] text-zinc-400 group-hover:text-gold transition-transform duration-300 group-hover:rotate-180">
                            ▼
                        </span>
                    </div>
                    
                    <div class="sub-menu-container absolute left-0 top-[100%] w-64 bg-white shadow-2xl rounded-sm opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-zinc-100">
                        <div class="py-2">
                            <a href="promotion.php" class="sub-menu-item">
                                <span class="mr-2">🏗️</span> PROMOTION IMMOBILIÈRE
                            </a>
                            <a href="particulier.php" class="sub-menu-item">
                                <span class="mr-2">🏠</span> PROPRIÉTÉ PARTICULIÈRE
                            </a>
                            <a href="terrains.php" class="sub-menu-item  active-link">
                                <span class="mr-2">🌱</span> TERRAIN ET PARCELLE
                            </a>
                        </div>
                    </div>
                </div>

                <a href="construction.php">CONSTRUCTION</a>
                <a href="expertise.php">EXPERTISE</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="tel:+2250708970664" class="hidden md:block btn-outline-gold">
                    APPEL DIRECT
                </a>

                <button id="menu-btn" class="md:hidden flex flex-col justify-between w-6 h-5 focus:outline-none">
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 flex flex-col items-center py-8 space-y-6 shadow-xl">
            <a href="index.php" class="font-semibold">ACCUEIL</a>
            <a href="catalogue.php" class="font-semibold">VENTE (TOUT VOIR)</a>
            <div class="flex flex-col items-center space-y-4 bg-zinc-50 w-full py-4 border-y border-zinc-100">
                <a href="promotion.php" class="text-sm">🏗️ Promotion immobilière</a>
                <a href="particulier.php" class="text-sm text-gold">🏠 Propriété particulière</a>
                <a href="terrains.php" class="text-sm">🌱 Terrain et parcelle</a>
            </div>
            <a href="construction.php" class="font-semibold">CONSTRUCTION</a>
            <a href="expertise.php" class="font-semibold">EXPERTISE</a>
            <a href="tel:+2250708970664" class="btn-outline-gold">Appel direct</a>
        </div>
    </nav>

    <header class="pt-48 pb-20 bg-zinc-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <span class="text-gold font-bold text-[10px] uppercase tracking-[0.5em] mb-4 block">Sécurité Juridique Garantie</span>
            <h1 class="font-luxury text-5xl md:text-7xl italic">Terrains & <span>Parcelles</span></h1>
            <p class="text-zinc-400 max-w-xl mt-6 text-sm leading-relaxed">
                Chaque parcelle est rigoureusement sélectionnée, avec ACD et études de sol à l'appui, pour sécuriser votre investissement foncier.
            </p>
        </div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    </header>

    <div class="max-w-5xl mx-auto px-6 -mt-10 relative z-20">
        <form action="terrains.php" method="GET" class="bg-white shadow-2xl rounded-2xl p-4 md:p-6 flex flex-col md:flex-row items-center gap-4 border border-zinc-100">
            
            <div class="flex-1 w-full group">
                <label class="block text-[9px] font-bold text-zinc-400 uppercase tracking-widest mb-1 ml-1">Localisation</label>
                <select name="loc" class="w-full bg-zinc-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-gold outline-none transition-all">
                    <option value="">Toutes les zones</option>
                    <?php foreach($localites as $loc): ?>
                        <option value="<?php echo htmlspecialchars($loc); ?>" <?php echo (isset($_GET['loc']) && $_GET['loc'] == $loc) ? 'selected' : ''; ?>>
                            📍 <?php echo htmlspecialchars($loc); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex-1 w-full">
                <label class="block text-[9px] font-bold text-zinc-400 uppercase tracking-widest mb-1 ml-1">Budget (FCFA)</label>
                <select name="budget" class="w-full bg-zinc-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-gold outline-none transition-all">
                    <option value="">Peu importe</option>
                    <option value="0-10000000" <?php echo (isset($_GET['budget']) && $_GET['budget'] == '0-10000000') ? 'selected' : ''; ?>>Entre 0 et 10 Millions</option>
                    <option value="10000000-30000000" <?php echo (isset($_GET['budget']) && $_GET['budget'] == '10000000-30000000') ? 'selected' : ''; ?>>Entre 10 et 30 Millions</option>
                    <option value="30000000-50000000" <?php echo (isset($_GET['budget']) && $_GET['budget'] == '30000000-50000000') ? 'selected' : ''; ?>>Entre 30 et 50 Millions</option>
                    <option value="50000000-100000000" <?php echo (isset($_GET['budget']) && $_GET['budget'] == '50000000-100000000') ? 'selected' : ''; ?>>Entre 50 et 100 Millions</option>
                    <option value="100000000-999999999" <?php echo (isset($_GET['budget']) && $_GET['budget'] == '100000000-999999999') ? 'selected' : ''; ?>>Au-dessus de 100 Millions</option>
                </select>
            </div>

            <div class="w-full md:w-auto self-end">
                <button type="submit" class="w-full bg-white text-black px-10 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#F15A29] hover:text-white transition-all shadow-lg">
                    Trouver ma parcelle
                </button>
            </div>

            <?php if(!empty($_GET)): ?>
                <a href="terrains.php" class="text-zinc-400 hover:text-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <main class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid grid-cols-1 gap-32">

            <?php if(count($terrains) > 0): ?>
                <?php foreach($terrains as $index => $t): ?>
                
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <div class="lg:col-span-7 <?php echo ($index % 2 != 0) ? 'order-1 lg:order-2' : ''; ?> relative group">
                        <div class="aspect-video bg-zinc-100 overflow-hidden rounded-sm">
                            <img src="uploads/<?php echo $t['photo_principale']; ?>" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                 alt="<?php echo htmlspecialchars($t['nom']); ?>">
                        </div>
                    </div>

                    <div class="lg:col-span-5 <?php echo ($index % 2 != 0) ? 'order-2 lg:order-1' : ''; ?> space-y-6">
                        <div class="flex justify-between items-start">
                            <h2 class="font-luxury text-4xl italic"><?php echo htmlspecialchars($t['nom']); ?></h2>
                        </div>
                        
                        <p class="text-zinc-500 text-sm leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($t['description'])); ?>
                        </p>

                        <?php if(!empty($t['lien_video'])): ?>
<div class="mt-4 flex justify-start">
    <a href="<?php echo $t['lien_video']; ?>" target="_blank" class="inline-flex items-center gap-4 bg-[#ff6600] hover:bg-[#e65c00] text-white px-8 py-4 rounded-full font-black text-[10px] uppercase tracking-[0.2em] shadow-lg shadow-orange-500/20 transition-all transform hover:-translate-y-1">
        <span class="relative flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
        </span>
        Voir la vidéo du terrain
    </a>
</div>
<?php endif; ?>

                        <div class="grid grid-cols-2 gap-4 border-y border-zinc-100 py-6">
                            <div>
                                <p class="text-[9px] uppercase text-zinc-400 font-bold">Surface </p>
                                <p class="font-bold"><?php echo htmlspecialchars($t['superficie']); ?> m²</p>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase text-zinc-400 font-bold">Localisation </p>
                                <p class="font-bold"><?php echo htmlspecialchars($t['localisation']); ?></p>
                            </div>
                        </div>

                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-[9px] uppercase text-zinc-400 font-bold">Prix Final</p>
                                <p class="text-2xl font-luxury text-gold">
                                    <?php echo number_format((float)$t['prix'], 0, ',', ' '); ?> 
                                    <span class="text-[10px] text-dark not-italic">FCFA</span>
                                </p>
                            </div>
                            <a href="https://wa.me/2250708970664?text=Je%20suis%20intéressé%20par%20le%20terrain%20<?php echo urlencode($t['nom']); ?>" class="bg-zinc-900 text-white px-8 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gold transition">
                                Réserver
                            </a>
                        </div>
                    </div>
                </section>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-20 border-2 border-dashed border-zinc-100">
                    <p class="text-zinc-400 italic font-luxury text-2xl">Aucun terrain ne correspond à votre budget dans cette zone pour le moment.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <footer class="bg-zinc-900 text-white py-12 text-center border-t border-white/5">
        <p class="text-[10px] tracking-[0.3em] uppercase opacity-40">© 2026 Terre Ivoire - Excellence Immobilière</p>
    </footer>
    
    <a href="https://wa.me/2250708970664" class="whatsapp-float" target="_blank">
        <span class="whatsapp-icon">
            <svg viewBox="0 0 448 512" width="25" height="25" fill="white">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.4 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.3-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.6-.3-8.6 2.5-11.3 2.5-2.5 5.5-6.5 8.3-9.7 2.8-3.3 3.7-5.6 5.5-9.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.4-29.8-17-41.1-4.5-10.9-9.1-9.4-12.4-9.6-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.5 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </span>
        <span class="float-text">Discutez avec nous 💬</span>
    </a>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>

</body>
</html>