<?php
require 'utils.php';

if (!empty($_POST['cv_resume'])) {
    $resume = $_POST['cv_resume'];

    $prompt = "Tu es un recruteur. Pose des questions d’entretien classiques à un candidat ayant ce profil :\n\n" . $resume . "\n\nCommence par la première question.";
    $response = callOpenAI($prompt);

    echo "<h2>Début de l'entretien simulé :</h2><pre>$response</pre>";
} else {
    echo "Résumé du CV requis.";
}
?>
