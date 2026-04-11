<?php 
include('db.php');

// On récupère tout ce qui est destiné au portfolio
$stmt = $pdo->prepare("SELECT * FROM produits_vente ORDER BY id DESC");
$stmt->execute();
$realisations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expertise | Terre d'Ivoire 🏗️</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="couleur.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                <a href="construction.php">CONSTRUCTION</a>
                <a href="expertise.php" class="active-link">EXPERTISE</a>
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

    <header class="pt-48 pb-20 bg-zinc-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <span class="text-gold font-bold text-[10px] uppercase tracking-[0.5em] mb-4 block">Conseil & Accompagnement</span>
            <h1 class="font-luxury text-5xl md:text-7xl mb-4 italic">Connaissance & <span>Expertise</span></h1>
            <p class="text-zinc-400 max-w-2xl text-sm leading-relaxed">
                Au-delà de la pierre, nous bâtissons une relation de confiance fondée sur la transparence administrative et la précision technique.
            </p>
        </div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    </header>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-8 rounded-2xl bg-gray-50 transition-transform hover:scale-105">
                    <div class="text-5xl mb-4">🎖️</div>
                    <div class="text-4xl font-bold text-[#F15A29] mb-2">15+</div>
                    <p class="text-gray-600 font-semibold uppercase tracking-wider text-sm">Années d'Expertise</p>
                </div>
                <div class="text-center p-8 rounded-2xl bg-gray-50 transition-transform hover:scale-105">
                    <div class="text-5xl mb-4">🏘️</div>
                    <div class="text-4xl font-bold text-[#F15A29] mb-2">100+</div>
                    <p class="text-gray-600 font-semibold uppercase tracking-wider text-sm">Projets Livrés</p>
                </div>
                <div class="text-center p-8 rounded-2xl bg-gray-50 transition-transform hover:scale-105">
                    <div class="text-5xl mb-4">🤝</div>
                    <div class="text-4xl font-bold text-[#F15A29] mb-2">100%</div>
                    <p class="text-gray-600 font-semibold uppercase tracking-wider text-sm">Satisfaction Clients</p>
                </div>
            </div>
        </div>
    </section>

   <section class="py-24 bg-white border-t border-zinc-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="space-y-32"> <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-zinc-100 rounded-2xl -z-10 group-hover:bg-zinc-200 transition-colors"></div>
                        <img src="images/acd.jpeg" alt="Suivi ACD" class="w-full h-[450px] object-cover rounded-xl shadow-2xl transition-transform duration-700 group-hover:scale-[1.02]">
                        <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm p-4 rounded-lg shadow-xl">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Sécurisation</p>
                            <p class="text-sm font-bold italic">Expertise Foncière 📜</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-12 flex items-center justify-center bg-zinc-900 text-white rounded-lg text-2xl">🏗️</span>
                            <h2 class="text-3xl font-bold italic">Suivi de l’ACD <br><span class="text-gold text-sm not-italic uppercase tracking-widest font-normal">(Arrêté de Concession Définitive)</span></h2>
                        </div>
                        <div class="h-1 w-20 bg-gold"></div>
                        <p class="text-zinc-600 leading-relaxed">
                            Le suivi de l’ACD constitue une étape essentielle dans la sécurisation de votre investissement foncier. Chez <strong>Terre Ivoire</strong>, nous vous accompagnons à chaque phase du processus administratif afin de garantir la régularité et la conformité de votre acquisition.
                        </p>
                        <p class="text-zinc-600 leading-relaxed">
                            De la constitution du dossier à son traitement auprès des services compétents, notre équipe veille à un suivi rigoureux et transparent.
                        </p>
                        <div class="p-6 bg-zinc-50 border-l-4 border-gold italic text-zinc-500 text-sm">
                            "Notre objectif est simple : vous permettre d’acquérir et de sécuriser votre bien en toute sérénité."
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-6 order-2 lg:order-1"> <div class="flex items-center gap-4">
                            <span class="w-12 h-12 flex items-center justify-center bg-zinc-900 text-white rounded-lg text-2xl">📐</span>
                            <h2 class="text-3xl font-bold italic">Étude de projet <br><span class="text-gold text-sm not-italic uppercase tracking-widest font-normal">Analyse & Optimisation</span></h2>
                        </div>
                        <div class="h-1 w-20 bg-gold"></div>
                        <p class="text-zinc-600 leading-relaxed">
                            Chaque projet immobilier mérite une réflexion approfondie. À travers notre service d’étude de projet, nous analysons votre besoin, votre budget et vos objectifs afin de vous proposer des solutions adaptées et optimisées.
                        </p>
                        <p class="text-zinc-600 leading-relaxed">
                            Nous vous accompagnons dans la conception de votre futur bien, en tenant compte des réalités du terrain et des contraintes techniques pour éviter les erreurs coûteuses.
                        </p>
                        <p class="text-zinc-600 leading-relaxed font-semibold">
                            Nous transformons votre vision en un projet concret, cohérent et rentable.
                        </p>
                    </div>

                    <div class="relative group order-1 lg:order-2">
                        <div class="absolute -inset-4 bg-zinc-100 rounded-2xl -z-10 group-hover:bg-zinc-200 transition-colors"></div>
                        <img src="images/etude.jpeg" alt="Étude de projet" class="w-full h-[450px] object-cover rounded-xl shadow-2xl transition-transform duration-700 group-hover:scale-[1.02]">
                        <div class="absolute top-6 right-6 bg-zinc-900/90 backdrop-blur-sm p-4 rounded-lg shadow-xl text-white">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gold">Conception</p>
                            <p class="text-sm font-bold italic">Vision & Réalité 📐</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="py-24 max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold mb-4 italic">Nos Réalisations 💎</h2>
        <div class="h-1 w-20 bg-[#F15A29] mx-auto mb-8"></div>
        
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <button class="filter-btn active" data-filter="all">🌟 Tout voir</button>
            <button class="filter-btn" data-filter="particulier">🏡 Propriétés Particulières</button>
            <button class="filter-btn" data-filter="terrain">🌱 Terrains Vendus</button>
            <button class="filter-btn" data-filter="promotion">🏗️ Promotions</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10" id="portfolio-grid">
        
        <?php if(count($realisations) > 0): ?>
            <?php foreach($realisations as $res): 
                // On s'assure que le data-category correspond aux filtres des boutons
                $category = htmlspecialchars($res['categorie']); 
            ?>
                <div class="project-card" data-category="<?php echo $category; ?>">
                    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
                        <img src="uploads/<?php echo $res['photo_principale']; ?>" 
                             class="w-full h-80 object-cover transition duration-700 group-hover:scale-110"
                             alt="<?php echo htmlspecialchars($res['nom']); ?>">
                        
                        <div class="absolute top-4 right-4 bg-zinc-900/80 backdrop-blur-md text-white px-4 py-1 rounded-full text-[10px] font-bold shadow-lg uppercase tracking-widest">
                            <?php echo isset($res['statut']) ? htmlspecialchars($res['statut']) : 'Réalisé'; ?>
                        </div>

                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="https://wa.me/2250708970664?text=Je%20souhaite%20plus%20d'infos%20sur%3A%20<?php echo urlencode($res['nom']); ?>" 
                               class="bg-white text-black px-6 py-3 rounded-full font-bold shadow-xl flex items-center gap-2 text-xs">
                                💬 Se renseigner
                            </a>
                        </div>
                    </div>
                    <div class="py-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold"><?php echo htmlspecialchars($res['nom']); ?></h3>
                            <span class="text-[#F15A29] text-xs font-bold"><?php echo $category; ?></span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2"><?php echo htmlspecialchars($res['localisation']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-10 text-gray-400 italic">
                Aucune réalisation à afficher pour le moment.
            </div>
        <?php endif; ?>

    </div>
</section>
 
            
       <section id="contact-form" class="py-24 bg-[#1a1a1a] text-white relative">
    <div class="max-w-4xl mx-auto px-6">
        <form action="send_contact.php" method="POST" class="bg-white p-10 rounded-3xl text-black grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="space-y-2">
                <label class="font-bold text-sm">Prénom & Nom 👤</label>
                <input type="text" name="nom" required placeholder="Ex: Marc Yao" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-xl focus:border-[#F15A29] outline-none">
            </div>

            <div class="space-y-2">
                <label class="font-bold text-sm">Email professionnel 📧</label>
                <input type="email" name="email" required placeholder="votre@mail.com" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-xl focus:border-[#F15A29] outline-none">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="font-bold text-sm">Objet de votre demande 🎯</label>
                <select name="objet" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-xl focus:border-[#F15A29] outline-none cursor-pointer">
                    <option value="Suivi ACD">🏗️ Suivi de l’ACD</option>
                    <option value="Étude de projet">📐 Étude de projet</option>
                    <option value="Achat">🏠 Achat de bien</option>
                </select>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="font-bold text-sm">Votre Message 📝</label>
                <textarea name="message" required rows="4" placeholder="Dites-nous tout..." class="w-full p-4 bg-gray-50 border border-gray-100 rounded-xl focus:border-[#F15A29] outline-none"></textarea>
            </div>

            <button type="submit" class="md:col-span-2 bg-[#F15A29] text-white py-5 rounded-xl font-bold hover:bg-black transition-all">
                Envoyer ma demande 🚀
            </button>
        </form>
    </div>
</section>



    <footer class="bg-zinc-900 text-white py-12 text-center">
        <p class="text-[10px] tracking-[0.3em] uppercase opacity-50 font-bold italic">© 2026 Terre Ivoire - L'Art de Construire</p>
    </footer>

   <script>
        // 1. GESTION DU MENU MOBILE
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // 2. FILTRAGE PORTFOLIO (Version optimisée avec animation)
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projects = document.querySelectorAll('.project-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // UI : Update boutons
                filterBtns.forEach(b => b.classList.remove('active', 'bg-gold', 'text-white'));
                btn.classList.add('active');

                const category = btn.getAttribute('data-filter');

                projects.forEach(project => {
                    const projectCat = project.getAttribute('data-category');
                    
                    if (category === 'all' || projectCat === category) {
                        project.style.display = 'block';
                        setTimeout(() => { project.style.opacity = '1'; }, 10);
                    } else {
                        project.style.opacity = '0';
                        project.style.display = 'none';
                    }
                });
            });
        });

        // 3. GESTION DE LA POPUP DE CONTACT (SweetAlert2)
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.has('sent')) {
                const status = urlParams.get('sent');
                
                if (status === '1') {
                    Swal.fire({
                        title: 'Message envoyé !',
                        text: 'Merci pour votre confiance. Notre équipe vous recontactera sous 24h.',
                        icon: 'success',
                        confirmButtonColor: '#F15A29',
                        confirmButtonText: 'D’accord',
                        background: '#ffffff'
                    }).then(() => {
                        // Nettoie l'URL proprement sans recharger la page
                        window.history.replaceState({}, document.title, window.location.pathname);
                    });
                } else if (status === '0') {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Une erreur technique a empêché l\'envoi. Réessayez ou contactez-nous par WhatsApp.',
                        icon: 'error',
                        confirmButtonColor: '#1a1a1a'
                    }).then(() => {
                        window.history.replaceState({}, document.title, window.location.pathname);
                    });
                }
            }
        });
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
</body>
</html>