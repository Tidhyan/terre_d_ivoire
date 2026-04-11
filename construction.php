<?php 
include('db.php'); 
// Récupération de tous les modèles
$reponse = $pdo->query("SELECT * FROM modeles_construction ORDER BY id DESC");
$projets = $reponse->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construction | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="couleur.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <style>
        /* Modales */
        .modal { 
            display: none; 
            position: fixed; 
            inset: 0; 
            background: rgba(0,0,0,0.98); 
            z-index: 9999; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .modal.active { display: flex; }

        /* Slider */
        .slider-viewport {
            width: 90%;
            max-width: 1000px;
            position: relative;
            overflow: hidden;
            border-radius: 4px;
        }
        .slider-container {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .slider-container img { flex: 0 0 100%; aspect-ratio: 16/9; object-fit: cover; }

        /* Navigation */
        .nav-btn {
            position: absolute;
            top: 50%; transform: translateY(-50%);
            background: rgba(0,0,0,0.6);
            color: white; width: 45px; height: 45px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; cursor: pointer; z-index: 20;
            transition: 0.3s;
        }
        .nav-btn:hover { background: var(--gold); }
        .prev { left: 15px; } .next { right: 15px; }

        .close-btn {
            position: absolute; top: 30px; right: 30px;
            color: white; font-size: 30px; cursor: pointer;
            width: 50px; height: 50px; background: rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; transition: 0.3s;
        }
        .close-btn:hover { background: #ff4d4d; }

        /* List Styling */
        .feature-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            font-style: italic;
            color: #4a4a4a;
        }
        .feature-list li::before {
            content: "•";
            position: absolute; left: 0;
            color: var(--gold);
            font-weight: bold;
        }
    </style>
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
                            <a href="particulier.php" class="sub-menu-item"><span class="mr-2">🏠</span> PROPRIÉTÉ PARTICULIÈRE</a>
                            <a href="terrains.php" class="sub-menu-item"><span class="mr-2">🌱</span> TERRAIN ET PARCELLE</a>
                        </div>
                    </div>
                </div>
                <a href="construction.php" class="active-link">CONSTRUCTION</a>
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

    <header class="pt-40 pb-20 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="font-luxury text-4xl md:text-6xl mb-4">Architecture <span>Visionnaire</span></h1>
            <p class="text-zinc-500 uppercase tracking-[0.2em] text-[10px] font-bold">Projets exclusifs à bâtir sur votre terrain</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <?php foreach ($projets as $projet): 
            $stmt = $pdo->prepare("SELECT * FROM photos_3d WHERE id_modele = ?");
            $stmt->execute([$projet['id']]);
            $photos_3d = $stmt->fetchAll();
            $total_photos = count($photos_3d);
        ?>
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start mb-32">
            <div class="lg:col-span-7 space-y-8">
                <div class="grid grid-cols-2 gap-3 bg-zinc-50 p-3 shadow-xl rounded-sm">
                    <div class="overflow-hidden">
                        <img src="uploads/<?php echo $projet['photo_principale_1']; ?>" class="w-full h-[500px] object-cover hover:scale-105 transition duration-700">
                    </div>
                    <div class="overflow-hidden">
                        <img src="uploads/<?php echo $projet['photo_principale_2']; ?>" class="w-full h-[500px] object-cover hover:scale-105 transition duration-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button onclick="openModal('modal-3d-<?php echo $projet['id']; ?>')" class="bg-zinc-900 text-white py-4 text-[11px] font-bold uppercase tracking-widest hover:bg-[#c5a059] transition italic">Photos 3D (<?php echo $total_photos; ?> Photos)</button>
                    <button onclick="openModal('modal-video-<?php echo $projet['id']; ?>')" class="bg-zinc-900 text-white py-4 text-[11px] font-bold uppercase tracking-widest hover:bg-[#c5a059] transition italic">Vidéo 3D</button>
                    <button onclick="toggleMT('mt-<?php echo $projet['id']; ?>')" class="border-2 border-zinc-900 py-4 text-[11px] font-bold uppercase tracking-widest hover:bg-zinc-900 hover:text-white transition italic">Matterport VR</button>
                </div>

                <div id="mt-<?php echo $projet['id']; ?>" class="hidden aspect-video bg-black rounded shadow-2xl overflow-hidden">
                    <iframe src="<?php echo $projet['lien_matterport']; ?>" class="w-full h-full" allowfullscreen></iframe>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-8">
                <div>
                    <p class="text-[11px] font-black uppercase tracking-[0.2em] text-zinc-400 mb-2"><?php echo $projet['slogan']; ?></p>
                    <h2 class="font-luxury text-7xl mb-6"><?php echo $projet['nom_modele']; ?></h2>
                    <p class="text-zinc-600 leading-relaxed mb-8 text-lg"><?php echo $projet['description']; ?></p>
                    <ul class="feature-list text-md border-l-2 border-zinc-100 ml-1">
                        <?php 
                        $features = explode(',', $projet['caracteristiques']);
                        foreach($features as $f) { if(!empty(trim($f))) echo "<li>".trim($f)."</li>"; } 
                        ?>
                    </ul>
                </div>

                <div class="p-8 bg-zinc-50 border border-zinc-100">
                    <p class="text-[10px] uppercase tracking-widest text-zinc-400 mb-3 font-bold">Budget estimatif de construction</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold font-luxury"><?php echo $projet['prix']; ?></span>
                        <span class="text-gold font-bold italic text-sm">FCFA (HORS TERRAIN)</span>
                    </div>
                </div>

                <a href="https://wa.me/2250708970664?text=Commande Plan <?php echo $projet['nom_modele']; ?>" class="block w-full bg-zinc-900 text-white text-center py-5 font-bold text-[12px] tracking-widest uppercase hover:bg-gold transition shadow-xl italic">
                    Commander ce plan
                </a>
            </div>

            <div id="modal-3d-<?php echo $projet['id']; ?>" class="modal">
                <span class="close-btn" onclick="closeModal('modal-3d-<?php echo $projet['id']; ?>')">&times;</span>
                <div class="slider-viewport">
                    <div class="nav-btn prev" onclick="moveSlide('<?php echo $projet['id']; ?>', -1, <?php echo $total_photos; ?>)">&#10094;</div>
                    <div class="nav-btn next" onclick="moveSlide('<?php echo $projet['id']; ?>', 1, <?php echo $total_photos; ?>)">&#10095;</div>
                    <div class="slider-container" id="slider-<?php echo $projet['id']; ?>">
                        <?php foreach($photos_3d as $img): ?>
                            <img src="uploads/<?php echo $img['chemin_image']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="flex gap-3 mt-8" id="dots-<?php echo $projet['id']; ?>">
                    <?php for($i=0; $i<$total_photos; $i++): ?>
                        <div class="w-2 h-2 rounded-full cursor-pointer transition-all duration-300 <?php echo $i===0 ? 'bg-[#c5a059] w-8' : 'bg-white/20'; ?>" onclick="goToSlide('<?php echo $projet['id']; ?>', <?php echo $i; ?>, <?php echo $total_photos; ?>)"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div id="modal-video-<?php echo $projet['id']; ?>" class="modal">
                <span class="close-btn" onclick="closeVideo('video-<?php echo $projet['id']; ?>', 'modal-video-<?php echo $projet['id']; ?>')">&times;</span>
                <div class="max-w-5xl w-full px-4">
                    <div class="aspect-video bg-black shadow-2xl border border-white/5">
                        <iframe id="video-<?php echo $projet['id']; ?>" width="100%" height="100%" src="<?php echo str_replace('watch?v=', 'embed/', $projet['lien_video']); ?>?enablejsapi=1&rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
    </main>

    <script>
        // Menu Mobile
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

        // Logique Modales & Sliders
        const sliderIndices = {};

        function openModal(id) {
            document.getElementById(id).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function closeVideo(iframeId, modalId) {
            const iframe = document.getElementById(iframeId);
            iframe.src = iframe.src;
            closeModal(modalId);
        }

        function toggleMT(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function moveSlide(id, n, total) {
            if (!sliderIndices[id]) sliderIndices[id] = 0;
            sliderIndices[id] = (sliderIndices[id] + n + total) % total;
            updateSliderUI(id, total);
        }

        function goToSlide(id, n, total) {
            sliderIndices[id] = n;
            updateSliderUI(id, total);
        }

        function updateSliderUI(id, total) {
            const idx = sliderIndices[id] || 0;
            const container = document.getElementById('slider-' + id);
            container.style.transform = `translateX(-${idx * 100}%)`;
            
            const dots = document.getElementById('dots-' + id).children;
            for(let i=0; i<dots.length; i++) {
                if(i === idx) {
                    dots[i].className = "w-8 h-2 rounded-full cursor-pointer transition-all duration-300 bg-[#c5a059]";
                } else {
                    dots[i].className = "w-2 h-2 rounded-full cursor-pointer transition-all duration-300 bg-white/20";
                }
            }
        }
    </script>


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