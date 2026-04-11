<?php 
include('db.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil | Terre d'Ivoire 🏗️</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="couleur.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
</head>
<body>

    <nav class="nav-glass fixed w-full z-50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <a href="index.php" class="flex items-center">
    <img src="images/logo.png" alt="Terre d'Ivoire Logo" 
         style="height: 100px; width: auto; object-fit: contain; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.1));">
</a>
        
        <div class="hidden md:flex items-center space-x-10 menu-links">
            <a href="index.php" class="active-link">ACCUEIL</a>
            
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
                        <a href="terrains.php" class="sub-menu-item">
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>


    <header class="relative h-[90vh] md:h-screen overflow-hidden bg-zinc-900">
    
    <div id="slider" class="relative h-full w-full">
        <div class="slide active">
            <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=2070" class="hero-img" alt="Villa Moderne">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-subtitle">L'IMMOBILIER DE PRESTIGE</p>
                <h1 class="hero-title">Construire, vendre et <br> valoriser <span>autrement</span></h1>
                <div class="hero-btns">
                    <a href="#vente" class="btn-gold">VOIR LES BIENS</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=2070" class="hero-img" alt="Intérieur Luxe">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-subtitle">EXPERTISE TECHNIQUE</p>
                <h1 class="hero-title">Votre projet sur mesure <br> de A à <span>Z</span></h1>
                <div class="hero-btns">
                    <a href="#construction" class="btn-gold">NOS PLANS</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070" class="hero-img" alt="Piscine de nuit">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-subtitle">OPPORTUNITÉS UNIQUES</p>
                <h1 class="hero-title">Des terrains titrés <br> aux zones <span>recherchées</span></h1>
                <div class="hero-btns">
                    <a href="https://wa.me/2250708970664" class="btn-gold">NOUS CONTACTER</a>
                </div>
            </div>
        </div>
    </div>

    <button onclick="prevSlide()" class="slider-btn prev" aria-label="Précédent">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" /></svg>
    </button>
    <button onclick="nextSlide()" class="slider-btn next" aria-label="Suivant">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" /></svg>
    </button>

    <div class="slider-dots">
        <div class="dot active" onclick="goToSlide(0)"></div>
        <div class="dot" onclick="goToSlide(1)"></div>
        <div class="dot" onclick="goToSlide(2)"></div>
    </div>
</header>
<script>
    let currentSlide = 0;
    // On sélectionne les éléments une seule fois pour la performance
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = slides.length;
    let autoPlayInterval;

    function showSlide(index) {
        // Retirer les classes actives
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        
        // Calcul du nouvel index (boucle infinie)
        currentSlide = (index + totalSlides) % totalSlides;
        
        // Ajouter les classes actives au nouveau slide
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
        
        // Reset l'auto-play pour éviter un changement brusque juste après un clic manuel
        startAutoPlay();
    }

    function nextSlide() { showSlide(currentSlide + 1); }
    function prevSlide() { showSlide(currentSlide - 1); }
    function goToSlide(index) { showSlide(index); }

    function startAutoPlay() {
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(nextSlide, 5000);
    }

    // Lancement au démarrage
    startAutoPlay();
</script>

    <section class="stats-section">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            
            <div class="stat-card">
                <span class="stat-number">15+</span>
                <h3 class="stat-title">Années d'Expertise</h3>
                <p class="stat-text">Expérience terrain confirmée dans le secteur immobilier.</p>
            </div>

            <div class="stat-card border-x-0 md:border-x border-zinc-100">
                <span class="stat-number">100%</span>
                <h3 class="stat-title">Satisfaction Clients</h3>
                <p class="stat-text">Un engagement total pour l'excellence et l'intégrité.</p>
            </div>

            <div class="stat-card">
                <span class="stat-number">100+</span>
                <h3 class="stat-title">Projets Livrés</h3>
                <p class="stat-text">Villas, duplex et programmes immobiliers de prestige.</p>
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-zinc-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="font-luxury text-3xl md:text-4xl mb-6 text-zinc-800">Pourquoi nous choisir ?</h2>
        <p class="text-zinc-500 leading-relaxed italic">
            "Notre mission est de transformer les visiteurs en futurs propriétaires en offrant des solutions clés en main et des plans personnalisables." 
        </p>
    </div>
</section>

<section id="vente" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-2xl">
                <h2 class="font-luxury text-4xl md:text-5xl mb-6">Propriétés de <span class="italic font-light">Légende</span></h2>
                <p class="text-zinc-500 uppercase tracking-widest text-xs">Découvrez notre sélection exclusive à la vente et en location de luxe </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <div class="property-card group">
                <div class="relative overflow-hidden bg-zinc-100 aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=2070" 
                         alt="Villa" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 text-[10px] font-bold tracking-widest uppercase">Promotion </div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-luxury text-xl">Villa Emeraude</h3>
                        <span class="text-gold font-bold text-sm underline">Sur Devis</span>
                    </div>
                    <p class="text-zinc-400 text-sm mb-4">Cocody Abidjan • 5 Pièces • 450 m² </p>
                    <div class="flex gap-4 border-t border-zinc-100 pt-4">
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-gold transition">Détails</a>
                        <a href="https://wa.me/2250708970664" class="text-xs font-bold uppercase tracking-widest text-green-600">WhatsApp </a>
                    </div>
                </div>
            </div>

            <div class="property-card group">
                <div class="relative overflow-hidden bg-zinc-100 aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2064" 
                         alt="Terrain" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-gold text-white px-3 py-1 text-[10px] font-bold tracking-widest uppercase text-nowrap">ACD Disponible </div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-luxury text-xl">Parcelle Horizon</h3>
                        <span class="text-gold font-bold text-sm uppercase underline">Vendu</span>
                    </div>
                    <p class="text-zinc-400 text-sm mb-4">Bingerville • 600 m² • Prêt à bâtir </p>
                    <div class="flex gap-4 border-t border-zinc-100 pt-4">
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-gold transition">Voir le plan</a>
                    </div>
                </div>
            </div>

            <div class="property-card group">
                <div class="relative overflow-hidden bg-zinc-100 aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070" 
                         alt="Appartement" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 text-[10px] font-bold tracking-widest uppercase">Location Prestige</div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-luxury text-xl">Penthouse Azure</h3>
                        <span class="text-gold font-bold text-sm">Prix / Nuit </span>
                    </div>
                    <p class="text-zinc-400 text-sm mb-4">Assinie • Vue Lagune • Service Conciergerie </p>
                    <div class="flex gap-4 border-t border-zinc-100 pt-4">
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-gold transition">Réserver </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>





<?php 
global $pdo; // On force l'accès à la connexion
$stmt_const = $pdo->query("SELECT * FROM modeles_construction ORDER BY id DESC LIMIT 2");
$dernières_constructions = $stmt_const->fetchAll();
?>

<section id="construction" class="py-24 bg-zinc-50">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-luxury text-4xl mb-4 text-zinc-800">Concevez votre futur <span>chez-vous</span></h2>
            <p class="text-zinc-500 tracking-wide text-sm uppercase tracking-[0.1em]">Expertise technique & Architecture visionnaire</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <?php foreach ($dernières_constructions as $index => $const): 
                // On prépare les caractéristiques (on en prend 3 max pour garder le design propre)
                $features = explode(',', $const['caracteristiques']);
            ?>
            <div class="bg-white p-2 rounded-sm shadow-sm border border-zinc-100 flex flex-col md:flex-row gap-8 group">
                <div class="md:w-1/2 overflow-hidden bg-zinc-200 aspect-square md:aspect-auto">
                    <img src="uploads/<?php echo $const['photo_principale_1']; ?>" 
                         alt="<?php echo $const['nom_modele']; ?>" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>

                <div class="md:w-1/2 py-6 pr-6 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-luxury text-2xl"><?php echo $const['nom_modele']; ?></h3>
                            <?php if($index === 0): ?>
                                <span class="bg-gold/10 text-gold text-[9px] px-2 py-1 font-bold uppercase tracking-widest">Dernier Cri</span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="text-zinc-400 text-[10px] uppercase font-bold tracking-widest mb-4 italic">
                            <?php echo $const['slogan']; ?>
                        </p>

                        <ul class="space-y-3 mb-8">
                            <?php for($i=0; $i<min(3, count($features)); $i++): ?>
                            <li class="flex items-start text-[11px] text-zinc-600 leading-tight">
                                <span class="text-gold mr-2">•</span>
                                <?php echo trim($features[$i]); ?>
                            </li>
                            <?php endfor; ?>
                        </ul>
                    </div>

                    <div class="border-t border-zinc-100 pt-6 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Investissement</p>
                            <p class="text-lg font-bold text-zinc-800 font-luxury italic">
    <?php 
        // On enlève les espaces ou caractères bizarres pour être sûr d'avoir un nombre
        $prix_nettoye = preg_replace('/[^0-9]/', '', $const['prix']); 
        echo number_format((float)$prix_nettoye, 0, ',', ' '); 
    ?> 
    <span class="text-[10px]">FCFA</span>
</p>
                        </div>
                        <a href="construction.php" class="inline-block bg-zinc-900 text-white px-6 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gold transition-colors shadow-lg">
                            Détails
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>




<?php 
// On récupère les 3 derniers modèles qui ont un lien Matterport
$stmt_3d = $pdo->query("SELECT * FROM modeles_construction 
                        WHERE lien_matterport IS NOT NULL 
                        AND lien_matterport != '' 
                        ORDER BY RAND() LIMIT 3");
$visites_3d = $stmt_3d->fetchAll();
?>

<section id="visites-3d" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="font-luxury text-4xl mb-4 text-zinc-800 uppercase tracking-tight">Expériences <span>Immersives</span></h2>
            <div class="h-[1px] w-12 bg-gold mx-auto mb-4"></div>
            <p class="text-zinc-500 uppercase tracking-[0.3em] text-[10px] font-bold italic">Visitez nos modèles de référence en 3D</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <?php foreach ($visites_3d as $visite): 
                // Traitement de l'URL Matterport pour s'assurer qu'elle est intégrable
                $url_3d = $visite['lien_matterport'];
                if (strpos($url_3d, 'matterport.com') !== false && strpos($url_3d, 'show?') === false) {
                    $url_3d = str_replace('.com/', '.com/show/?m=', $url_3d);
                }
            ?>
            <div class="cursor-pointer group" onclick="open3D('<?php echo $url_3d; ?>')">
                <div class="relative aspect-video overflow-hidden rounded-sm mb-4 shadow-md bg-zinc-100">
                    <?php $img = !empty($visite['photo_principale_1']) ? $visite['photo_principale_1'] : $visite['photo_principale']; ?>
                    <img src="uploads/<?php echo $img; ?>" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition flex items-center justify-center">
                        <span class="bg-white/90 text-zinc-900 px-4 py-2 text-[10px] font-bold tracking-widest uppercase shadow-xl transform group-hover:scale-110 transition-transform">Lancer la visite</span>
                    </div>
                </div>
                <h3 class="font-luxury text-xl text-zinc-800"><?php echo $visite['nom_modele']; ?></h3>
                <p class="text-zinc-400 text-xs mt-1 italic"><?php echo $visite['slogan'] ?? 'Architecture Signature'; ?></p>
            </div>
            <?php endforeach; ?>

        </div>

        <div id="viewer-3d" class="hidden mt-16 animate-fade-in">
            <div class="relative w-full aspect-video md:aspect-[21/9] bg-black rounded-sm overflow-hidden shadow-2xl border-4 border-white">
                <button onclick="close3D()" class="absolute top-4 right-4 z-20 bg-white text-black px-4 py-2 text-[10px] font-bold uppercase tracking-widest hover:bg-gold hover:text-white transition shadow-lg">Fermer la vue X</button>
                <iframe id="matterport-iframe" src="" frameborder="0" allowfullscreen allow="xr-spatial-tracking" class="w-full h-full"></iframe>
            </div>
        </div>
    </div>
</section>

<script>
    function open3D(link) {
        const viewer = document.getElementById('viewer-3d');
        const iframe = document.getElementById('matterport-iframe');
        
        iframe.src = link;
        viewer.classList.remove('hidden');
        
        // Scroll fluide vers le lecteur
        setTimeout(() => {
            viewer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 150);
    }

    function close3D() {
        const viewer = document.getElementById('viewer-3d');
        const iframe = document.getElementById('matterport-iframe');
        
        viewer.classList.add('hidden');
        iframe.src = ""; // Stop le flux en fermant
    }
</script>

<script>
    function open3D(link) {
        const viewer = document.getElementById('viewer-3d');
        const iframe = document.getElementById('matterport-iframe');
        iframe.src = link;
        viewer.classList.remove('hidden');
        viewer.scrollIntoView({ behavior: 'smooth' });
    }

    function close3D() {
        const viewer = document.getElementById('viewer-3d');
        const iframe = document.getElementById('matterport-iframe');
        viewer.classList.add('hidden');
        iframe.src = "";
    }
</script>



<footer class="bg-zinc-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/10 pb-16">
            
            <div class="col-span-1 md:col-span-1">
                <div class="logo text-white mb-6">TERRE D'IVOIRE</div>
                <p class="text-zinc-400 text-xs leading-relaxed tracking-wide">
                    L'excellence immobilière en Côte d'Ivoire. Construire, vendre et valoriser autrement.
                </p>
            </div>

            <div>
                <h4 class="text-gold font-bold text-[10px] uppercase tracking-[0.2em] mb-6">Navigation</h4>
                <ul class="text-zinc-400 text-sm space-y-4">
                    <li><a href="#" class="hover:text-white transition">Accueil</a></li>
                    <li><a href="#vente" class="hover:text-white transition">Biens en vente</a></li>
                    <li><a href="#construction" class="hover:text-white transition">Plans de construction</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-gold font-bold text-[10px] uppercase tracking-[0.2em] mb-6">Contact</h4>
                <ul class="text-zinc-400 text-sm space-y-4">
                    <li>Abidjan, Côte d'Ivoire</li>
                    <li><a href="tel:+2250708970664" class="hover:text-white transition">+225 07 08 970 664</a></li>
                    <li>contact@terre-divoire.com</li>
                </ul>
            </div>

            <div>
                <h4 class="text-gold font-bold text-[10px] uppercase tracking-[0.2em] mb-6">Suivez-nous</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:border-gold hover:text-gold transition">FB</a>
                    <a href="#" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:border-gold hover:text-gold transition">IG</a>
                    <a href="#" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:border-gold hover:text-gold transition">IN</a>
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col md:row justify-between items-center gap-4 text-[10px] text-zinc-500 uppercase tracking-widest">
            <p>© 2026 TERRE D'IVOIRE. TOUS DROITS RÉSERVÉS.</p>
            <p>DESIGNÉ POUR L'EXCELLENCE</p>
        </div>
    </div>
</footer>

<a href="https://wa.me/2250708970664" class="whatsapp-float" target="_blank" title="Discutez avec nous sur WhatsApp">
    <span class="whatsapp-icon">
        <svg viewBox="0 0 448 512" width="25" height="25" fill="white">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.4 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.3-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.6-.3-8.6 2.5-11.3 2.5-2.5 5.5-6.5 8.3-9.7 2.8-3.3 3.7-5.6 5.5-9.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.4-29.8-17-41.1-4.5-10.9-9.1-9.4-12.4-9.6-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.5 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
    </span>
    <span class="float-text">Discutez avec nous 💬</span>
</a>


</body>
</html>