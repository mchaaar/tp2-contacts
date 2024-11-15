<?php
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id > 0) {
        $contact = getContactById($id);

        if ($contact) {
            return $contact;
        } else {
            exit("Aucun contact trouvé avec l'ID $id.");
        }
    } else {
        exit("Veuillez fournir un ID valide.");
    }
} else {
    exit("Méthode non autorisée ou ID non fourni.");
}
