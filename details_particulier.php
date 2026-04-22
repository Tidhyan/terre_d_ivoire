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

// On prépare le tableau de toutes les images pour le slider (principale + galerie)
$all_images = [];
if(!empty($item['photo_principale'])) { $all_images[] = $item['photo_principale']; }
foreach($images as $img) { $all_images[] = $img['chemin_image']; }
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
                <a href="particulier.php" class="text-sm">🏠 Propriété particulière</a>
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
                    <span class="text-gold font-bold text-[10px] uppercase tracking-[0.5em] mb-4 block">Programme d'Exception</span>
                    <h1 class="font-luxury text-5xl md:text-7xl">Villa <span><?php echo htmlspecialchars($item['nom']); ?></span></h1>
                    <p class="text-zinc-400 mt-2 uppercase tracking-widest text-xs font-bold">📍 <?php echo htmlspecialchars($item['localisation']); ?></p>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-zinc-400 text-[10px] uppercase font-bold">Prix de vente final</p>
                    <p class="text-4xl font-luxury text-dark">
                        <?php 
                            $prix_nettoye = preg_replace('/[^0-9]/', '', $item['prix']); 
                            echo number_format((float)$prix_nettoye, 0, ',', ' '); 
                        ?> 
                        <span class="text-sm not-italic">FCFA</span>
                    </p>
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 py-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 h-[400px] md:h-[550px]">
            <div class="md:col-span-8 h-full overflow-hidden rounded-sm relative group">
                <img src="uploads/<?php echo $item['photo_principale']; ?>" class="w-full h-full object-cover transition duration-1000 group-hover:scale-105">
                <div class="absolute bottom-6 left-6 bg-black/40 text-white text-[9px] px-3 py-1.5 backdrop-blur-md uppercase tracking-widest">Vue Principale</div>
            </div>
            
            <div class="md:col-span-4 h-full relative overflow-hidden rounded-sm group cursor-pointer" onclick="openGallery(1)">
                <?php if(isset($all_images[1])): ?>
                    <img src="uploads/<?php echo $all_images[1]; ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 gallery-overlay flex flex-col items-center justify-center text-white">
                        <span class="text-3xl font-light">+<?php echo count($all_images) - 1; ?></span>
                        <span class="text-[10px] uppercase tracking-[0.2em] font-bold border-b border-gold/50 pb-1">Voir les photos</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(!empty($item['video_youtube'])): ?>
    <div class="mt-8 flex justify-center">
        <a href="<?php echo htmlspecialchars($item['video_youtube']); ?>" 
           target="_blank" 
           class="inline-flex items-center gap-4 bg-[#ff6600] hover:bg-[#e65c00] text-white px-10 py-5 rounded-full font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-orange-500/20 transition-all transform hover:-translate-y-1">
            
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
            
            Voir la vidéo du bien
        </a>
    </div>
<?php endif; ?>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2 space-y-16">
                <section>
                    <h3 class="font-luxury text-3xl mb-8 italic">
                        <?php echo !empty($item['accroche']) ? htmlspecialchars($item['accroche']) : 'Un écrin de <span>Modernité</span>'; ?>
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
                                <p class="text-lg font-bold"><?php echo !empty($item['parking']) ? htmlspecialchars($item['parking']) : 'Inclus'; ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <?php if(!empty($item['matterport']) || !empty($item['lien_video'])): ?>
                <section id="section-video" class="pt-10">
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-6 flex items-center gap-4 italic">
                        Visite Immersive & Vidéo <span class="h-[1px] flex-1 bg-zinc-100"></span>
                    </h3>
                    <div class="aspect-video w-full shadow-2xl bg-black rounded-sm overflow-hidden border-4 border-white">
                        <?php 
                            $url = !empty($item['matterport']) ? $item['matterport'] : $item['lien_video'];
                            $url = str_replace("watch?v=", "embed/", $url);
                        ?>
                        <iframe src="<?php echo $url; ?>" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                    </div>
                </section>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-32 bg-zinc-900 text-white p-8 rounded-sm shadow-2xl border-t-4 border-gold">
                    <h3 class="font-luxury text-2xl mb-6">Demande d'<span>Informations</span></h3>
                    <p class="text-zinc-400 text-xs mb-8 leading-relaxed">Nos conseillers sont à votre disposition pour organiser une visite privée de ce bien d'exception.</p>
                    <a href="https://wa.me/2250708970664?text=Bonjour,%20je%20souhaite%20visiter%20: <?php echo urlencode($item['nom']); ?>" class="block w-full text-center bg-gold text-white py-5 font-bold text-[10px] tracking-[0.2em] uppercase hover:bg-white hover:text-zinc-900 transition-all duration-500">
                        Prendre rendez-vous ✨
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-zinc-900 text-white py-10 text-center">
        <p class="text-[9px] tracking-[0.3em] uppercase opacity-40">© 2026 Terre Ivoire - Excellence Immobilière</p>
    </footer>

    <div id="galleryModal" class="fixed inset-0 z-[100] bg-black/95 hidden flex items-center justify-center p-4">
        <button onclick="closeGallery()" class="absolute top-6 right-6 text-white text-5xl hover:text-gold transition-colors z-[110]">&times;</button>
        
        <div class="relative w-full max-w-5xl">
            <?php foreach($all_images as $index => $img_path): ?>
                <div class="gallery-slide hidden animate-fadeIn">
                    <img src="uploads/<?php echo $img_path; ?>" class="max-h-[85vh] mx-auto object-contain shadow-2xl">
                    <p class="text-white/50 mt-6 text-[10px] tracking-[0.3em] uppercase text-center">Photo <?php echo $index + 1; ?> / <?php echo count($all_images); ?></p>
                </div>
            <?php endforeach; ?>

            <button onclick="changeSlide(-1)" class="absolute left-0 top-1/2 -translate-y-1/2 p-4 text-white text-3xl hover:text-gold">❮</button>
            <button onclick="changeSlide(1)" class="absolute right-0 top-1/2 -translate-y-1/2 p-4 text-white text-3xl hover:text-gold">❯</button>
        </div>
    </div>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.gallery-slide');

        function openGallery(index) {
            document.getElementById('galleryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            showSlide(index);
        }

        function closeGallery() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function changeSlide(n) {
            showSlide(currentSlideIndex + n);
        }

        function showSlide(n) {
            if (n >= slides.length) currentSlideIndex = 0;
            else if (n < 0) currentSlideIndex = slides.length - 1;
            else currentSlideIndex = n;

            slides.forEach(s => s.classList.add('hidden'));
            slides[currentSlideIndex].classList.remove('hidden');
        }

        // Fermer la modale si on clique à côté de l'image
        document.getElementById('galleryModal').onclick = function(e) {
            if(e.target === this) closeGallery();
        }

        // Menu mobile
        const menuBtn = document.getElementById('menu-btn');
        if(menuBtn) {
            menuBtn.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        }
    </script>

</body>
</html>