<?php require_once './includes/header.php'; ?>
<?php require_once './data/data.php';
$contacts = getAllContacts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css" rel="stylesheet">
    <title>Gestion des Contacts</title>
</head>

<body>
    <div class="container-all">
        <h1>Gestion des Contacts</h1>
        <div class="container-add-contact">
            <h2>Ajouter un contact</h2>
            <form method="POST" action="data/add_contact.php" id="addContactForm">
                <div>
                    <label for="name">Nom :</label>
                    <input type="text" name="name" id="name" maxlength="50" 
                           title="Le nom ne doit pas dépasser 50 caractères."
                           required>
                </div>
                <div>
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" name="telephone" id="telephone" 
                           pattern="^\+?[0-9]+$" 
                           title="Téléphone doit contenir uniquement des chiffres."
                           required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" 
                           pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
                           title="Veuillez entrer un email valide."
                           required>
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="container-list">
            <h2>Liste des contacts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['name']) ?></td>
                            <td><?= htmlspecialchars($contact['telephone']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $contact['id'] ?>">
                                    Modifier
                                </a>
                                <a href="data/delete_contact.php?id=<?= $contact['id'] ?>" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('addContactForm').addEventListener('submit', function (e) {
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

<?php require_once './includes/footer.php'; ?>

</html>
