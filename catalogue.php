<?php 
include('db.php'); 
// On récupère uniquement la catégorie 'particulier'
$stmt = $pdo->prepare("SELECT * FROM produits_vente WHERE categorie = 'particulier' ORDER BY id DESC");
$stmt->execute();
$biens = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétés Particulières | Terre d'Ivoire</title>
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
                <a href="index.php">ACCUEIL</a>
                
                <div class="relative group py-4">
                    <div class="flex items-center cursor-pointer">
                        <a href="catalogue.php" class="hover:text-gold transition-colors active-link">VENTE</a>
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

    <header class="pt-40 pb-20 bg-zinc-50 border-b border-zinc-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-zinc-500 uppercase tracking-[0.2em] text-[10px] font-bold mb-4">Solutions Clés en Main</p>
            <h1 class="font-luxury text-4xl md:text-6xl mb-4">Nos Biens<span>Disponibles</span></h1>
            <p class="text-zinc-400 max-w-2xl mx-auto text-sm">Explorez notre catalogue immobilier.</p>
        </div>
    </header>


    <main class="py-20 bg-white">
        
        <div class="max-w-7xl mx-auto px-6 mb-32 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2 space-y-6">
                <span class="text-gold text-[10px] font-black uppercase tracking-[0.5em]">L'Art de Vivre</span>
                <h2 class="font-luxury text-5xl italic leading-tight text-zinc-900">Une Sélection <br><span>Sans Compromis</span></h2>
                <div class="h-[2px] w-24 bg-gold"></div>
                <p class="text-zinc-600 leading-relaxed text-sm max-w-lg">
                    Chaque bien de notre catalogue est une promesse d'exclusivité. Nous arpentons la Côte d'Ivoire pour dénicher des lieux d'exception, où l'architecture audacieuse rencontre des emplacements stratégiques. Que vous cherchiez la sérénité d'une villa en bordure de lagune ou l'effervescence d'un penthouse au Plateau, Terre d'Ivoire est votre boussole dans l'immobilier de prestige.
                </p>
            </div>
            <div class="md:w-1/2 relative group">
                <div class="absolute -inset-4 border border-zinc-100 group-hover:border-gold transition-colors duration-500 rounded-sm -z-10"></div>
                <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=2070"  alt="Excellence Immobilière" class="w-full h-[500px] object-cover rounded-sm shadow-2xl transition-transform duration-1000 group-hover:scale-105">
            </div>
        </div>

        <div class="bg-zinc-50 py-32 border-y border-zinc-100 relative overflow-hidden">
            <div class="absolute -top-10 -left-10 text-[20rem] opacity-5 text-gold font-bold">💎</div>

            <div class="max-w-7xl mx-auto px-6 space-y-48">
                
                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <div class="lg:w-7/12 relative group order-2 lg:order-1">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=2070"  alt="Promotion" class="w-full h-[550px] object-cover shadow-2xl rounded-sm transition-all duration-700 grayscale-[0.3] group-hover:grayscale-0 group-hover:scale-105">
                        <div class="absolute -bottom-10 -right-10 p-8 bg-black/90 text-white w-2/3 shadow-2xl rounded-sm border border-white/5">
                            <h4 class="font-luxury text-2xl italic mb-3">Programmes Neufs</h4>
                            <p class="text-white/70 text-xs leading-relaxed">Cités résidentielles connectées et complexes mixtes. Investissez dans l'avenir durable d'Abidjan.</p>
                        </div>
                    </div>
                    <div class="lg:w-5/12 space-y-6 order-1 lg:order-2">
                        <span class="text-gold text-[10px] font-black uppercase tracking-[0.3em]">Investissement & Modernité</span>
                        <h3 class="text-5xl font-bold font-luxury italic text-zinc-900">Promotion Immobilière</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">Découvrez nos projets d'envergure, conçus pour les investisseurs exigeants.</p>
                        <a href="promotion.php" class="inline-block pt-4 text-[11px] font-black uppercase tracking-[0.2em] text-zinc-900 border-b-2 border-gold pb-1 group-hover:pr-4 transition-all">Explorer les programmes</a>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <div class="lg:w-5/12 space-y-6 text-right">
                        <span class="text-gold text-[10px] font-black uppercase tracking-[0.3em]">Prestige & Caractère</span>
                        <h3 class="text-5xl font-bold font-luxury italic text-zinc-900">Propriété Particulière</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">L'émotion d'un lieu unique. Des résidences rares, sélectionnées pour leur âme et leur vue imprenable.</p>
                        <a href="particulier.php" class="inline-block pt-4 text-[11px] font-black uppercase tracking-[0.2em] text-zinc-900 border-b-2 border-gold pb-1 group-hover:pl-4 transition-all">Découvrir les demeures</a>
                    </div>
                    <div class="lg:w-7/12 relative group">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=2070"  alt="Particulier" class="w-full h-[550px] object-cover shadow-2xl rounded-sm transition-all duration-700 grayscale-[0.3] group-hover:grayscale-0 group-hover:scale-105">
                        <div class="absolute -top-10 -left-10 p-8 bg-white/95 text-black w-2/3 shadow-2xl rounded-sm border border-zinc-100">
                            <h4 class="font-luxury text-2xl italic mb-3">Villas de Luxe</h4>
                            <p class="text-zinc-600 text-xs leading-relaxed">Résidences pieds dans l'eau à Assinie ou duplex contemporains à Cocody.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <div class="lg:w-7/12 relative group order-2 lg:order-1">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=2070"  alt="Terrains" class="w-full h-[550px] object-cover shadow-2xl rounded-sm transition-all duration-700 grayscale-[0.3] group-hover:grayscale-0 group-hover:scale-105">
                        <div class="absolute -bottom-10 -left-10 p-8 bg-zinc-100 text-black w-2/3 shadow-2xl rounded-sm border border-zinc-200">
                            <h4 class="font-luxury text-2xl italic mb-3">Parcelles Sécurisées</h4>
                            <p class="text-zinc-600 text-xs leading-relaxed">Terrains avec ACD, études de sol et viabilisation complète. Bâtissez sans stress.</p>
                        </div>
                    </div>
                    <div class="lg:w-5/12 space-y-6 order-1 lg:order-2">
                        <span class="text-gold text-[10px] font-black uppercase tracking-[0.3em]">Sécurité & Avenir</span>
                        <h3 class="text-5xl font-bold font-luxury italic text-zinc-900">Terrains & Parcelles</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">Le premier pas vers la maison de vos rêves. Les meilleurs emplacements de la région.</p>
                        <a href="terrains.php" class="inline-block pt-4 text-[11px] font-black uppercase tracking-[0.2em] text-zinc-900 border-b-2 border-gold pb-1 group-hover:pr-4 transition-all">Consulter les lots</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-32 space-y-16">
            <div class="text-center max-w-lg mx-auto">
                <h2 class="font-luxury text-4xl mb-4 leading-tight">Nos Plus Belles <span>Opportunités</span></h2>
                <div class="h-1 w-20 bg-gold mx-auto mb-6"></div>
                <p class="text-zinc-500 text-xs">Un aperçu exclusif de nos biens d'exception du moment.</p>
            </div>

            <div class="max-w-7xl mx-auto px-6 py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <div class="lg:col-span-7 grid grid-cols-12 gap-4 h-[600px]">
                <div class="col-span-8 h-full relative overflow-hidden group">
                    <img src="images/service_1.jpg" class="w-full h-full object-cover rounded-sm transition-transform duration-1000 group-hover:scale-110" alt="Conciergerie">
                    <div class="absolute inset-0 bg-black/20"></div>
                </div>
                <div class="col-span-4 grid grid-rows-2 gap-4 h-full">
                    <div class="relative overflow-hidden group">
                        <img src="images/service_2.jpg" class="w-full h-full object-cover rounded-sm transition-transform duration-1000 group-hover:scale-110" alt="Conseil">
                        <div class="absolute inset-0 bg-zinc-900/40"></div>
                    </div>
                    <div class="relative overflow-hidden group border-2 border-gold/20">
                        <img src="images/service_3.jpg" class="w-full h-full object-cover rounded-sm transition-transform duration-1000 group-hover:scale-110" alt="Signature">
                        <div class="absolute inset-0 bg-gold/10"></div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-10">
                <div class="space-y-4">
                    <span class="text-gold text-[10px] font-black uppercase tracking-[0.4em]">Pourquoi nous choisir</span>
                    <h2 class="font-luxury text-4xl italic leading-tight">L'Excellence comme <br><span>Seul Standard</span></h2>
                    <div class="h-1 w-20 bg-gold"></div>
                </div>

                <div class="space-y-8">
                    <div class="flex gap-6 group">
                        <span class="text-2xl font-luxury italic text-gold group-hover:-translate-y-1 transition-transform">01.</span>
                        <div>
                            <h4 class="font-bold text-sm uppercase tracking-wider mb-2">Sécurisation Totale</h4>
                            <p class="text-zinc-500 text-xs leading-relaxed">Chaque bien ou terrain subit un audit rigoureux. Nous ne vendons que ce que nous pouvons garantir juridiquement.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 group">
                        <span class="text-2xl font-luxury italic text-gold group-hover:-translate-y-1 transition-transform">02.</span>
                        <div>
                            <h4 class="font-bold text-sm uppercase tracking-wider mb-2">Accompagnement Sur-Mesure</h4>
                            <p class="text-zinc-500 text-xs leading-relaxed">De la première visite à la remise des clés, un conseiller dédié orchestre chaque détail de votre acquisition.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 group">
                        <span class="text-2xl font-luxury italic text-gold group-hover:-translate-y-1 transition-transform">03.</span>
                        <div>
                            <h4 class="font-bold text-sm uppercase tracking-wider mb-2">Réseau Off-Market</h4>
                            <p class="text-zinc-500 text-xs leading-relaxed">Accédez à des propriétés qui ne sont jamais publiées ailleurs. La discrétion est notre marque de fabrique.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="expertise.php" class="inline-flex items-center gap-4 bg-zinc-900 text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gold transition-all group shadow-2xl">
                        Découvrir notre expertise 
                        <span class="group-hover:translate-x-2 transition-transform">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
        </div>
    </main>








    <footer class="bg-zinc-900 text-white py-12 text-center">
        <p class="text-[10px] tracking-[0.3em] uppercase opacity-50">© 2026 Terre Ivoire - Excellence Immobilière</p>
    </footer>

    <a href="https://wa.me/2250708970664" class="whatsapp-float" target="_blank">
        <span class="whatsapp-icon">
            <svg viewBox="0 0 448 512" width="25" height="25" fill="white">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.4 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.3-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.6-.3-8.6 2.5-11.3 2.5-2.5 5.5-6.5 8.3-9.7 2.8-3.3 3.7-5.6 5.5-9.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.4-29.8-17-41.1-4.5-10.9-9.1-9.4-12.4-9.6-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.5 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </span>
    </a>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn) btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</body>
</html>