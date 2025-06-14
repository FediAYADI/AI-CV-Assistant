<?php
require 'utils.php';

if (isset($_FILES['cv']) && isset($_POST['action'])) {
    $file = $_FILES['cv']['tmp_name'];
    $cv_text = file_get_contents($file);
    $action = $_POST['action'];

    if ($action == "reformulation") {
        $prompt = "Voici un CV brut. Reformule-le de manière professionnelle et structurée :\n\n" . $cv_text;
    } elseif ($action == "lettre") {
        $prompt = "Voici un CV :\n" . $cv_text . "\n\nRédige une lettre de motivation pour un poste de développeur web junior dans une entreprise technologique.";
    } else {
        echo "Action non reconnue.";
        exit;
    }

    $result = callOpenAI($prompt);
    echo "<h2>Résultat IA :</h2><pre>$result</pre>";
} else {
    echo "Fichier ou action manquante.";
}
?>
