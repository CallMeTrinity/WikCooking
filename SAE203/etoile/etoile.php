<?php $id = intval($_GET['id']);?>
<link type="text/css" rel="stylesheet" href="../Recipe/etoile.css">
<div class="notation">
    <table>
        <tr>
            <td><div class="etoile" id="1"></div></td>
            <td><div class="etoile" id="2"></div></td>
            <td><div class="etoile" id="3"></div></td>
            <td><div class="etoile" id="4"></div></td>
            <td><div class="etoile" id="5"></div></td>
        </tr>
    </table>
    <form method="post" action="/etoile/etoile.php">
        <input id="numero" name="note" type="number" hidden>
        <input id="recipeId" name="recipe_id" type="hidden" value="<?php echo $id;?>">

        <input type="submit" class="invisible">
    </form>
    <script type="text/javascript" rel="script" src="../Recipe/etoile.js"></script>
</div>


<?php

include_once '../config.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifie si la note est présente et valide
    if (isset($_POST['note']) && is_numeric($_POST['note']) && $_POST['note'] >= 1 && $_POST['note'] <= 5) {
        $note = $_POST['note'];
        $recipe_id = $_POST['recipe_id'];
    } else {
        $recipe_id = $_POST['recipe_id'];
        header('Location: /Recipe/recipe1.php?id='.$recipe_id);
        die("Note invalide !");
    }

    // Connexion à la base de données
    try {
        $conn = new PDO(DB, USER, PWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // Préparation de la requête SQL
    $query = "INSERT INTO recipe_rating (recipe_id, rating) VALUES (:recipe_id, :rating)";

    try {
        $stmt = $conn->prepare($query);
        // Assurez-vous de définir correctement la variable $recipe_id avant de l'utiliser ici.
        $stmt->bindParam(':recipe_id', $recipe_id);
        $stmt->bindParam(':rating', $note);
        $stmt->execute();
        header('Location: /Recipe/recipe1.php?id='.$recipe_id);
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la note : " . $e->getMessage();
    }
}
?>
