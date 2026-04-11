<?php 
include('db.php');

// 1. On récupère l'ID depuis l'URL
if(!isset($_GET['id'])) { header('Location: particulier.php'); exit(); }
$id = $_GET['id'];

// 2. On récupère les infos du bien
$stmt = $pdo->prepare("SELECT * FROM produits_vente WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if(!$item) { echo "Bien non trouvé"; exit(); }

// 3. On récupère la galerie photo associée
$gal = $pdo->prepare("SELECT * FROM photos_vente_galerie WHERE id_produit = ?");
$gal->execute([$id]);
$images = $gal->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($item['nom']); ?> | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="couleur.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
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
                        <span class="ml-2 text-[10px] text-zinc-400 group-hover:text-gold transition-transform duration-300 group-hover:rotate-180">▼</span>
                    </div>
                    <div class="sub-menu-container absolute left-0 top-[100%] w-64 bg-white shadow-2xl rounded-sm opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-zinc-100">
                        <div class="py-2">
                            <a href="promotion.php" class="sub-menu-item"><span class="mr-2">🏗️</span> PROMOTION IMMOBILIÈRE</a>
                            <a href="particulier.php" class="sub-menu-item active-link"><span class="mr-2">🏠</span> PROPRIÉTÉ PARTICULIÈRE</a>
                            <a href="terrains.php" class="sub-menu-item"><span class="mr-2">🌱</span> TERRAIN ET PARCELLE</a>
                        </div>
                    </div>
                </div>
                <a href="construction.php">CONSTRUCTION</a>
                <a href="expertise.php">EXPERTISE</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="tel:+2250708970664" class="hidden md:block btn-outline-gold">APPEL DIRECT</a>
                <button id="menu-btn" class="md:hidden flex flex-col justify-between w-6 h-5 focus:outline-none">
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                    <span class="w-full h-0.5 bg-black rounded-full"></span>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 flex flex-col items-center py-8 space-y-6 shadow-xl">
            <a href="index.php" class="font-semibold">ACCUEIL</a>
            <a href="catalogue.php" class="font-semibold text-gold">VENTE (TOUT VOIR)</a>
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

    <header class="pt-40 pb-10 bg-white border-b border-zinc-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-gold font-bold text-[10px] uppercase tracking-[0.5em] mb-4 block">Patrimoine Privé</span>
                    <h1 class="font-luxury text-5xl md:text-7xl"><?php echo htmlspecialchars($item['nom']); ?></h1>
                    <p class="text-zinc-400 mt-2 uppercase tracking-widest text-xs font-bold">📍 <?php echo htmlspecialchars($item['localisation']); ?></p>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-zinc-400 text-[10px] uppercase font-bold">Prix demandé</p>
                    <p class="text-4xl font-luxury text-dark">
                        <?php 
                            $prix_nettoye = preg_replace('/[^0-9]/', '', $item['prix']); 
                            echo !empty($prix_nettoye) ? number_format((float)$prix_nettoye, 0, ',', ' ') : 'Sur demande'; 
                        ?> 
                        <span class="text-sm not-italic">FCFA</span>
                    </p>
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 h-[400px] md:h-[600px] overflow-hidden rounded-sm group relative">
                <img src="uploads/<?php echo $item['photo_principale']; ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                <div class="absolute bottom-6 left-6 bg-black/50 text-white text-[10px] px-4 py-2 backdrop-blur-md uppercase tracking-widest">Vue Principale</div>
            </div>
            
            <div class="md:col-span-4 grid grid-cols-2 md:grid-cols-1 gap-4">
                <?php 
                $count = 0;
                foreach($images as $img): 
                    if($count < 2): 
                ?>
                    <div class="h-[190px] md:h-[292px] overflow-hidden rounded-sm">
                        <img src="uploads/<?php echo $img['chemin_image']; ?>" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                <?php 
                    endif;
                    $count++;
                endforeach; 
                ?>
            </div>
        </div>

        <?php if(count($images) > 2): ?>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
            <?php for($i=2; $i < count($images); $i++): ?>
                <div class="h-48 md:h-64 overflow-hidden rounded-sm">
                    <img src="uploads/<?php echo $images[$i]['chemin_image']; ?>" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2 space-y-16">
                
                <section>
                    <h3 class="font-luxury text-3xl mb-8 italic">
                        <?php echo !empty($item['accroche']) ? htmlspecialchars($item['accroche']) : 'Demeure de <span>Caractère</span>'; ?>
                    </h3>
                    <div class="prose text-zinc-600 text-sm leading-relaxed max-w-3xl">
                        <p class="mb-10"><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-8 border-t border-zinc-100">
                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase">Surface</p>
                                <p class="text-lg font-bold"><?php echo htmlspecialchars($item['superficie']); ?> m²</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase">Pièces</p>
                                <p class="text-lg font-bold"><?php echo htmlspecialchars($item['pieces']); ?> Pièces</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase">Parking</p>
                                <p class="text-lg font-bold"><?php echo !empty($item['parking']) ? htmlspecialchars($item['parking']) : 'Disponible'; ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-8 flex items-center gap-4">
                        Options de livraison disponibles
                        <span class="h-[1px] flex-1 bg-zinc-100"></span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <?php if(isset($item['livraison_gros_oeuvre']) && $item['livraison_gros_oeuvre'] == 1): ?>
                        <div class="group p-8 border border-zinc-100 bg-white relative overflow-hidden transition-all duration-500 hover:border-zinc-400">
                            <span class="absolute -right-2 -top-2 text-4xl opacity-5 font-luxury group-hover:opacity-10 transition-opacity">01</span>
                            <div class="w-10 h-10 bg-zinc-100 text-zinc-900 flex items-center justify-center rounded-full mb-4 group-hover:bg-zinc-900 group-hover:text-white transition-colors">🏗️</div>
                            <h4 class="font-luxury text-xl mb-2 italic">Gros <span>Œuvre</span></h4>
                            <p class="text-zinc-500 text-[11px] leading-relaxed">Structure, toiture et maçonnerie extérieure terminées. Idéal pour personnaliser l'intérieur.</p>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($item['livraison_cle_main']) && $item['livraison_cle_main'] == 1): ?>
                        <div class="group p-8 border border-zinc-900 bg-zinc-900 text-white relative overflow-hidden transition-all duration-500 hover:shadow-xl">
                            <span class="absolute -right-2 -top-2 text-4xl opacity-10 font-luxury">02</span>
                            <div class="w-10 h-10 bg-gold text-white flex items-center justify-center rounded-full mb-4 shadow-lg shadow-gold/20">✨</div>
                            <h4 class="font-luxury text-xl mb-2 italic text-white">Clé en <span>main</span></h4>
                            <p class="text-zinc-300 text-[11px] leading-relaxed">Prêt à habiter. Finitions de prestige, équipements haut de gamme et espaces aménagés.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>

                <?php if(!empty($item['matterport']) || !empty($item['lien_video'])): ?>
                <section class="bg-zinc-50 p-4 border border-zinc-100 rounded-sm">
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-4 italic">Immersion & Vidéo</h3>
                    <div class="aspect-video w-full shadow-xl bg-white">
                        <?php 
                            $url = !empty($item['matterport']) ? $item['matterport'] : $item['lien_video'];
                            if (strpos($url, 'matterport.com') !== false && strpos($url, 'show?') === false) {
                                $url = str_replace('.com/', '.com/show/?m=', $url);
                            }
                            $url = str_replace("watch?v=", "embed/", $url);
                        ?>
                        <iframe src="<?php echo $url; ?>" class="w-full h-full" frameborder="0" allowfullscreen allow="xr-spatial-tracking"></iframe>
                    </div>
                </section>
                <?php endif; ?>

                <?php if(!empty($item['caracteristiques'])): ?>
                <section>
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-8 flex items-center gap-4">
                        Équipements & Atouts
                        <span class="h-[1px] flex-1 bg-zinc-100"></span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php 
                        $specs = explode(',', $item['caracteristiques']);
                        foreach($specs as $s): 
                        ?>
                        <div class="flex items-center p-4 bg-zinc-50 rounded-sm text-sm">
                            <span class="w-1.5 h-1.5 bg-gold rounded-full mr-3"></span>
                            <?php echo trim($s); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-32">
                    <div class="bg-zinc-900 text-white p-8 rounded-sm shadow-2xl">
                        <h3 class="font-luxury text-2xl mb-8">Demande d'<span>Informations</span></h3>
                        <p class="text-zinc-400 text-xs mb-8 leading-relaxed">Cette propriété vous intéresse ? Nos conseillers sont à votre disposition pour organiser une visite privée.</p>
                        <a href="https://wa.me/2250708970664?text=Bonjour,%20je%20souhaite%20plus%20d'informations%20sur%20la%20propriété%20<?php echo urlencode($item['nom']); ?>" class="block w-full text-center bg-gold text-white py-5 font-bold text-[10px] tracking-[0.2em] uppercase hover:bg-white hover:text-dark transition duration-500">
                            Contacter un Agent ✨
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-zinc-900 text-white py-10 text-center border-t border-white/5">
        <p class="text-[9px] tracking-[0.3em] uppercase opacity-40">© 2026 Terre Ivoire - Excellence Immobilière</p>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    </script>

</body>
</html>