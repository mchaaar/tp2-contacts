<?php
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if (deleteContact($id)) {
        header('Location: ../index.php');
        exit;
    } else {
        echo "Erreur lors de la suppression du contact.";
    }
} else {
    echo "ID du contact non fourni ou méthode non autorisée.";
}
