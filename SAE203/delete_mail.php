<?php

require_once 'config.php';

try {
    $conn = new PDO(DB, USER, PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

if (isset($_GET['mail_id'])) {
    $mail_id = $_GET['mail_id'];

    $query = "DELETE FROM mail WHERE mail_id = :mail_id";

    try {
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mail_id', $mail_id);
        $stmt->execute();
        echo "Email supprimé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'email: " . $e->getMessage();
    }

    $stmt = null;
    $conn = null;
    header('Location: mon_compte.php');
}

