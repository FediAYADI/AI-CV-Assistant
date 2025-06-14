<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'utils.php';

$resultatIA = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contenu = $_POST['contenu'] ?? '';
    $type = $_POST['type'] ?? 'cv';

    if (!empty($contenu)) {
        $prompt = '';
        switch ($type) {
            case 'cv':
                $prompt = "Reformule ce CV de manière professionnelle :\n\n" . $contenu;
                break;
            case 'motivation':
                $prompt = "Génère une lettre de motivation adaptée à ce CV :\n\n" . $contenu;
                break;
            case 'entretien':
                $prompt = "Simule une série de questions d’entretien pour ce profil :\n\n" . $contenu;
                break;
        }

        $resultatIA = callOpenAI($prompt);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Assistant RH IA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="text">🤖 Assistant RH IA 🤖</h2>
            <form method="POST" action="index.php">
                <div class="mb-3">
                    <label for="contenu" class="form-label">Collez votre CV textuellement :</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="8" required><?= isset($_POST['contenu']) ? htmlspecialchars($_POST['contenu']) : '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Choisir une option :</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="cv" id="type1" <?= (!isset($_POST['type']) || $_POST['type'] === 'cv') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="type1">Reformuler CV</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="motivation" id="type2" <?= (isset($_POST['type']) && $_POST['type'] === 'motivation') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="type2">Lettre de motivation</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="entretien" id="type3" <?= (isset($_POST['type']) && $_POST['type'] === 'entretien') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="type3">Simuler entretien</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">🚀 Lancer l’analyse IA</button>
                </div>
            </form>

            <?php if (!empty($resultatIA)): ?>
                <div class="mt-5">
                    <h4 class="text-success">✅ Résultat généré par l’IA :</h4>
                    <div class="border p-3 bg-white rounded shadow-sm" style="white-space: pre-line;">
                        <?= htmlspecialchars($resultatIA) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS (si besoin) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
