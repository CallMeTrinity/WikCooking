<?php


require_once 'config.php';

$mailId = filter_input(INPUT_GET, 'mail_id', FILTER_SANITIZE_NUMBER_INT);

try {
    $conn = new PDO(DB, USER, PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM mail WHERE mail_id = :mail_id');
    $stmt->bindParam(':mail_id', $mailId);
    $stmt->execute();

    $mail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($mail) {
        header('Location: mailto:' . $mail['mail_from'] . '?subject=En réponse à votre mail&body=' . rawurlencode("Pour répondre à votre mail: \n" . $mail['mail_message']));
        exit;
    } else {
        echo 'Mail not found';
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

