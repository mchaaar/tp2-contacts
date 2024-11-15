<?php
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $errors = [];

    if (empty($name)) {
        $errors[] = "Le nom est obligatoire.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est obligatoire.";
    }
    if (empty($telephone)) {
        $errors[] = "Le numéro de téléphone est obligatoire.";
    }

    if (empty($errors)) {
        if (updateContact($id, $name, $email, $telephone)) {
            header('Location: ../index.php');
            exit;
        } else {
            $errors[] = "Erreur lors de la mise à jour du contact.";
        }
    }
}
