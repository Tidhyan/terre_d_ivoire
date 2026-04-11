<?php
session_start();
// Si déjà connecté, on redirige vers le dashboard
if(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true){
    header('Location: admin_dashboard.php');
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Tes identifiants
    if ($login === "admin" && $password === "terredivoire@2026") {
        $_SESSION['admin_logged'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = "Identifiants incorrects 🛑";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin | Terre d'Ivoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
</head>
<body class="bg-zinc-900 h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
             <a href="index.php" class="flex items-center">
    <img src="images/logo.png" alt="Terre d'Ivoire Logo" 
         style="height: 100px; width: auto; object-fit: contain; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.1));">
</a>
            <p class="text-gray-400 text-sm">Espace Administration</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-center text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2">Identifiant</label>
                <input type="text" name="login" required class="w-full p-4 bg-gray-50 border rounded-xl outline-none focus:border-[#D4AF37]">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest mb-2">Mot de passe</label>
                <input type="password" name="password" required class="w-full p-4 bg-gray-50 border rounded-xl outline-none focus:border-[#D4AF37]">
            </div>
            <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-[#D4AF37] transition-all duration-300">
                SE CONNECTER
            </button>
        </form>
    </div>
</body>
</html>