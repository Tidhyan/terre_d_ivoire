<?php
session_start();
// Sécurité : si pas de session, retour au login
if(!isset($_SESSION['admin_logged'])){
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
</head>
<body class="bg-gray-50 font-sans">
    
    <nav class="bg-white border-b p-6 flex justify-between items-center shadow-sm">
        <h1 class="font-bold text-xl italic text-zinc-800">Terre d'Ivoire <span class="text-[#D4AF37]">Admin</span></h1>
        

<a href="index.php" class="inline-flex items-center gap-2 bg-black text-white px-6 py-3 rounded-xl font-bold hover:bg-[#D4AF37] transition-all duration-300 shadow-lg">
    <span>←</span> Retour au site
</a>

        
        <a href="logout.php" class="text-red-500 text-sm font-bold hover:underline">DÉCONNEXION</a>
    </nav>

    <main class="max-w-6xl mx-auto py-16 px-6">
        <h2 class="text-3xl font-bold mb-10 text-center">Que souhaitez-vous gérer ? 🛠️</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <a href="admin_construction.php" class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-[#D4AF37] transition-all hover:-translate-y-2">
                <div class="text-4xl mb-4">🏗️</div>
                <h3 class="text-xl font-bold mb-2">CONSTRUCTION</h3>
                <p class="text-gray-500 text-sm">Gérer les chantiers en cours et les réalisations btp.</p>
                <div class="mt-6 text-[#D4AF37] font-bold group-hover:translate-x-2 transition-transform">Accéder →</div>
            </a>

            <a href="admin_terrain.php" class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-[#D4AF37] transition-all hover:-translate-y-2">
                <div class="text-4xl mb-4">🌱</div>
                <h3 class="text-xl font-bold mb-2">TERRAINS</h3>
                <p class="text-gray-500 text-sm">Mise à jour des parcelles vendues et disponibles.</p>
                <div class="mt-6 text-[#D4AF37] font-bold group-hover:translate-x-2 transition-transform">Accéder →</div>
            </a>

            <a href="admin_vente.php" class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-[#D4AF37] transition-all hover:-translate-y-2">
                <div class="text-4xl mb-4">💎</div>
                <h3 class="text-xl font-bold mb-2">VENTES</h3>
                <p class="text-gray-500 text-sm">Promotions immobilières & Propriétés particulières.</p>
                <div class="mt-6 text-[#D4AF37] font-bold group-hover:translate-x-2 transition-transform">Accéder →</div>
            </a>

        </div>
    </main>
</body>
</html>