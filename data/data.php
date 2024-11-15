<?php
require_once __DIR__ . '/../includes/db.php';

/**
 * Validates the name field.
 *
 * @param string $name
 * @return string|null Validation error message, or null if valid.
 */
function validateName(string $name): ?string {
    if (empty($name)) {
        return "Name cannot be empty.";
    } elseif (strlen($name) > 50) {
        return "Name cannot exceed 50 characters.";
    }
    return null;
}

/**
 * Validates the email field.
 *
 * @param string $email
 * @return string|null Validation error message, or null if valid.
 */
function validateEmail(string $email): ?string {
    if (empty($email)) {
        return "Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return null;
}

/**
 * Validates the telephone field.
 *
 * @param string $telephone
 * @return string|null Validation error message, or null if valid.
 */
function validateTelephone(string $telephone): ?string {
    if (empty($telephone)) {
        return "Telephone cannot be empty.";
    } elseif (!preg_match('/^\+?[0-9]+$/', $telephone)) {
        return "Telephone must contain only numbers;";
    }
    return null;
}

/**
 * Sanitizes an input to prevent XSS attacks.
 *
 * @param string $input
 * @return string Sanitized input.
 */
function sanitizeInput(string $input): string {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Adds a contact to the database.
 *
 * @param string $name
 * @param string $email
 * @param string $telephone
 * @return bool
 */
function addContact(string $name, string $email, string $telephone): bool {
    $conn = connectDB();
    $name = sanitizeInput($name);
    $email = sanitizeInput($email);
    $telephone = sanitizeInput($telephone);
    $errors = [];

    if ($error = validateName($name)) {
        $errors[] = $error;
    }
    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }
    if ($error = validateTelephone($telephone)) {
        $errors[] = $error;
    }

    if (!empty($errors)) {
        error_log("Validation errors: " . implode(", ", $errors));
        return false;
    }

    try {
        $query = $conn->prepare("INSERT INTO contacts (name, email, telephone) VALUES (:name, :email, :telephone)");
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        return $query->execute();
    } catch (PDOException $e) {
        error_log("Error adding contact: " . $e->getMessage());
        return false;
    }
}

/**
 * Retrieves all contacts from the database.
 *
 * @return array
 */
function getAllContacts(): array {
    $conn = connectDB();

    try {
        $query = $conn->query("SELECT * FROM contacts");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching contacts: " . $e->getMessage());
        return [];
    }
}

/**
 * Deletes a contact by ID.
 *
 * @param int $id
 * @return bool
 */
function deleteContact(int $id): bool {
    $conn = connectDB();

    if ($id <= 0) {
        error_log("Invalid ID for deletion.");
        return false;
    }

    try {
        $query = $conn->prepare("DELETE FROM contacts WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } catch (PDOException $e) {
        error_log("Error deleting contact: " . $e->getMessage());
        return false;
    }
}

/**
 * Updates a contact by ID.
 *
 * @param int $id
 * @param string $name
 * @param string $email
 * @param string $telephone
 * @return bool
 */
function updateContact(int $id, string $name, string $email, string $telephone): bool {
    $conn = connectDB();
    $name = sanitizeInput($name);
    $email = sanitizeInput($email);
    $telephone = sanitizeInput($telephone);
    $errors = [];
    
    if ($error = validateName($name)) {
        $errors[] = $error;
    }
    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }
    if ($error = validateTelephone($telephone)) {
        $errors[] = $error;
    }

    if (!empty($errors)) {
        error_log("Validation errors: " . implode(", ", $errors));
        return false;
    }

    if ($id <= 0) {
        error_log("Invalid ID for update.");
        return false;
    }

    try {
        $query = $conn->prepare("UPDATE contacts SET name = :name, email = :email, telephone = :telephone WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        return $query->execute();
    } catch (PDOException $e) {
        error_log("Error updating contact: " . $e->getMessage());
        return false;
    }
}

/**
 * Retrieves a contact by ID.
 *
 * @param int $id
 * @return array|null
 */
function getContactById(int $id): ?array {
    $conn = connectDB();

    if ($id <= 0) {
        error_log("Invalid ID for fetching contact.");
        return null;
    }

    try {
        $query = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    } catch (PDOException $e) {
        error_log("Error fetching contact by ID: " . $e->getMessage());
        return null;
    }
}
