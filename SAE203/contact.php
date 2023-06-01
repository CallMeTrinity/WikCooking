<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);
    echo "Mail: $mail <br>";
    echo "Message: $message <br>";

    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully <br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $query = "INSERT INTO mail (mail_from, mail_message, mail_date) VALUES (:mail, :message, CURDATE())";
    try {
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        echo "New record created successfully <br>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
