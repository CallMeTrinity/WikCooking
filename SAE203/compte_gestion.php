<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined("DB") or define("DB", "mysql:host=127.0.0.1;dbname=wikDB");
defined("USER") or define("USER", "toto");
defined("PWD") or define("PWD", "050904100402PA");

try {
    $conn = new PDO(DB, USER, PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE user_login = ?");
        $stmt->execute([$username]);

        $user = $stmt->fetch();
        if ($user && $password === $user['user_password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['user_role'];
            echo json_encode(['error' => false]); // On envoie une réponse JSON
            exit;
        } else {
            echo json_encode(['error' => true, 'message' => 'Le nom d\'utilisateur ou le mot de passe est incorrect.']); // On envoie une réponse JSON avec le message d'erreur
            exit;
        }
    }
}


if(isset($_POST['usernameSignUp']) && isset($_POST['passwordSignUp']) && isset($_POST['mailSignUp'])){
    $usernameSignUp = $_POST['usernameSignUp'];
    $passwordSignUp = $_POST['passwordSignUp'];
    $mailSignUp = $_POST['mailSignUp'];
    $role = 'member'; // Vous pouvez définir le rôle par défaut pour les nouveaux utilisateurs ici.

    // Vérifiez d'abord si l'utilisateur existe déjà
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_login = ?");
    $stmt->execute([$usernameSignUp]);

    if ($stmt->fetch()) {
        header('Location: compte.php?show=signup');;
    } else {
        // Si l'utilisateur n'existe pas, ajoutez-le à la base de données
        $stmt = $conn->prepare("INSERT INTO user (user_login, user_password, user_email, user_role) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$usernameSignUp, $passwordSignUp, $mailSignUp, $role])) {
            // Vous pouvez rediriger l'utilisateur vers la page de connexion ici, ou faire autre chose.
            $_SESSION['username'] = $usernameSignUp;
            $_SESSION['role'] = $role;
            header('Location: accueil.php');
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}





?>

