<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage
    $nom     = strip_tags(trim($_POST['nom']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $objet   = strip_tags(trim($_POST['objet']));
    $message = strip_tags(trim($_POST['message']));

    // Configuration
    $to      = "contact@terredivoire.ci"; // TON EMAIL ICI
    $subject = "Nouveau Contact : $objet";
    
    // Corps du mail en HTML
    $body = "<h2>Nouveau message de Terre d'Ivoire</h2>";
    $body .= "<b>Nom:</b> $nom <br>";
    $body .= "<b>Email:</b> $email <br>";
    $body .= "<b>Objet:</b> $objet <br><br>";
    $body .= "<b>Message:</b><br>$message";

    // En-têtes pour mail HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Terre d'Ivoire <noreply@terredivoire.ci>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Envoi et redirection
    if (mail($to, $subject, $body, $headers)) {
        header("Location: expertise.php?sent=1#contact-form");
    } else {
        header("Location: expertise.php?sent=0#contact-form");
    }
    exit();
}