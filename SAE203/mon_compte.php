<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <?php include 'link.inc.php' ?>
    <link rel="stylesheet" href="/assets/css/mon_compte.css">
</head>
<body>
<?php include_once 'header.inc.php' ?>

<main>
    <?php
    $salt = "pomme_de_terre";
    if (!isset($_SESSION['username'])) {
        header('Location: compte.php');
        exit;
    }
//    echo "<div class='welcome-message'>Bienvenue " . $_SESSION['username'] . " !</div>";

    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }

    if ($_SESSION['role'] == 'admin') {
        echo "<section class='admin-section'>";
        echo "<p class='presentation'>Vous êtes admin : voici les tables : </p><br>";
        echo "<div class='user-table-container'>"; // Add this div
        echo "<table class='tableUser'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>";
        echo "user_num";
        echo "</th>";
        echo "<th>";
        echo "user_login";
        echo "</th>";
        echo "<th>";
        echo "user_password";
        echo "</th>";
        echo "<th>";
        echo "user_email";
        echo "</th>";
        echo "<th>";
        echo "user_role";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";

        $query = "SELECT * FROM user";
        $res = $conn->query($query);
        if (!$res) die("Failed query " . $query);
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>";
            echo "<p> " . $row['user_num'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['user_login'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . crypt($row['user_password'], $salt) . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['user_email'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['user_role'] . " </p>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</table>";
        echo "</div>";

//mail
        echo "<div class='email-section'>";
        $query = "SELECT * FROM mail ORDER BY mail_date DESC";
        $res = $conn->query($query);
        if (!$res) die("Failed query " . $query);
        echo '<div class="email-container">';
        foreach ($res as $row) {
            echo '<div class="email-card">';
            echo '<div class="email-content">';
            echo '<h2 class="email-from">' . $row['mail_from'] . '</h2>';
            echo '<p class="email-date">' . $row['mail_date'] . '</p>';
            echo '<p class="email-message">' . $row['mail_message'] . '</p>';
            echo '</div>';
            echo '<div class="email-buttons">';
            echo '<a href="/reply_mail.php?mail_id=' . $row['mail_id'] . '"target="_blank" class="btn btn-reply"><i class="fa fa-reply" aria-hidden="true"></i>
</a>';
            echo '<a href="/delete_mail.php?mail_id=' . $row['mail_id'] . '" class="btn btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
</a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo "</div>";


        echo "</section>";
    }

    if ($_SESSION['role'] === 'editor' || $_SESSION['role'] === 'admin'){
    echo "Vous êtes éditeur, voici les recettes : "; ?>
    <table class='tableRecipe' id="tableRecipe">
        <button id="defaultSortButton">Tri par défaut</button>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Recherchez une recette..">


        <thead id="tableHeader">
        <tr>
            <th id="idHeader">ID</th>
            <th id="titleHeader">Titre</th>
            <th id="authorHeader">Auteur</th>
            <th id="descHeader">Description</th>
            <th id="dateHeader">Date</th>
            <th id="ingredientHeader">Ingrédient</th>
            <th id="instructionsHeader">Instructions</th>
        </tr>
        </thead>


        <?php
        $query = "SELECT * FROM recipe";
        $res = $conn->query($query);
        if (!$res) die("Failed query " . $query);
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>";
            echo $row['recipe_id'];
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['recipe_title'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['recipe_author'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['recipe_desc'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['recipe_date'] . " </p>";
            echo "</td>";
            echo "<td>";
            echo "<p> " . $row['recipe_ingredient'] . " </p>";
            echo "</td>";
            echo "<td class='instruction'>";
            echo "<p> " . $row['recipe_instruction'] . " </p>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</table>";
        }

        if (isset($_SESSION['role'])) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_login = :username");
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->execute();
            $res = $stmt->fetch();

            if (!$res) die("Failed query " . $query);
            ?>
            <div class="profile-card">
                <form action="update_profile.php" method="POST" id="profileForm">
                    <img src="/assets/images/profilePicture.png" alt="Profile Image" class="profile-image">
                    <div class="profile-info">
                        <input type="text" name="user_name" class="user-name" value="<?php echo $res['user_login']; ?>" disabled>
                        <input type="email" name="user_email" class="user-email" value="<?php echo $res['user_email']; ?>" disabled>
                        <p class="user-role"><?php echo $res['user_role']; ?></p>
                        <button type="button" id="editButton">Modifier le profil</button>
                        <input type="submit" id="saveButton" value="Enregistrer" style="display: none;">
                    </div>
                </form>
            </div>


            <?php

        }

        ?>

    </table>
    <?php if($_SESSION['role']==='admin'){ ?>
    <div class="reset_database">

        <a href="init.php" class="tout">
            <div class="btn">
                <div class="rouge">
                    <div class="carrered"></div>

                    <div class="disquerouge"></div>
                </div>
                <div class="gris">
                    <div class="disquegris"></div>

                    <div class="carregris"></div>
                </div>
            </div>
        </a>
        <p>Reset Database</p>
        </div>
<?php } ?>

</main>

<?php include 'footer.inc.php' ?>
<script src="/assets/js/mon_compte.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#editButton").click(function(){
            $(".user-name, .user-email").prop("disabled", false);
            $("#saveButton").show();
            $(this).hide();
        });
    });
</script>

</body>
</html>



