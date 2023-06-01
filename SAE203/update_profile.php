<?php
require_once 'config+connexion.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    // You might want to add some checks here for data validity and security

    try {
        $query = $conn->prepare("UPDATE user SET user_login = :user_login, user_email = :user_email WHERE user_login = :old_user_login");
        $query->execute([
            ':user_login' => $user_name,
            ':user_email' => $user_email,
            ':old_user_login' => $_SESSION['username'],
        ]);

        // Updating the session variable as well
        $_SESSION['username'] = $user_name;


        echo "Profile updated successfully.";
        header('Location: mon_compte.php');
    } catch (PDOException $e) {
        echo "Failed to update profile: " . $e->getMessage();
    }
}

