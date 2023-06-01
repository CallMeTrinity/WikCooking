<?php
require 'config+connexion.php';

if(isset($_POST['usernameSignUp'])){
    $usernameSignUp = $_POST['usernameSignUp'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE user_login = ?");
    $stmt->execute([$usernameSignUp]);

    if ($stmt->fetch()) {
        echo "Le nom d'utilisateur existe déjà.";
    } else {
        echo "";
    }
}
