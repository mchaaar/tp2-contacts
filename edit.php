<?php
require_once './includes/header.php';
require_once './data/data.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID invalide ou non fourni.</p>";
    echo '<a href="index.php">Retour à la liste des contacts</a>';
    exit();
}

$id = intval($_GET['id']);
$contact = getContactById($id);

if (!$contact) {
    echo "<p>Contact non trouvé.</p>";
    echo '<a href="index.php">Retour à la liste des contacts</a>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un contact</title>
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-full-edit">
        <h1>Modifier un contact</h1>
        <div class="container-edit">
        <form method="POST" action="data/update_contact.php" id="updateContactForm">
                <input type="hidden" name="id" value="<?= htmlspecialchars($contact['id']) ?>">
                <div>
                    <label for="name">Nom :</label>
                    <input type="text" name="name" id="name" 
                           value="<?= htmlspecialchars($contact['name']) ?>" 
                           maxlength="50" 
                           title="Le nom ne doit pas dépasser 50 caractères."
                           required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" 
                           value="<?= htmlspecialchars($contact['email']) ?>" 
                           pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" 
                           title="Veuillez entrer un email valide."
                           required>
                </div>
                <div>
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" name="telephone" id="telephone" 
                           value="<?= htmlspecialchars($contact['telephone']) ?>" 
                           pattern="^\+?[0-9]+$" 
                           title="Téléphone doit contenir uniquement des chiffres."
                           required>
                </div>
                <button type="submit">Mettre à jour</button>
            </form>
            <br>
            <div class="back-button-container">
                <a href="index.php" class="button-back">Retour aux contacts</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('updateContactForm').addEventListener('submit', function (e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const telephone = document.getElementById('telephone').value;
            const nameMaxLength = 50;
            const phoneRegex = /^\+?[0-9]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (name.length > nameMaxLength) {
                e.preventDefault();
                alert(`Le nom ne doit pas dépasser ${nameMaxLength} caractères.`);
                return;
            }

            if (!phoneRegex.test(telephone)) {
                e.preventDefault();
                alert("Téléphone doit contenir uniquement des chiffres.");
                return;
            }

            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert("Veuillez entrer un email valide.");
                return;
            }
        });
    </script>
</body>

</html>
