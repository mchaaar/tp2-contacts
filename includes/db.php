<?php
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "contacts_db";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        exit("Connection failed: " . $e->getMessage());
    }
}
