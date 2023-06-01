<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIK Cooking</title>

    <?php include '../link.inc.php';?>
    <link rel="stylesheet" href="/assets/css/recipe.css">
</head>
<body>
<?php include_once '../header.inc.php'?>
<main class="contenu_recipe">
    <?php
    require_once '../config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $recipe_id = intval($_GET['id']); // Nettoyer et valider l'id de la recette
    } else {
        die("Invalid recipe ID!");
    }

    $query1 = "SELECT * FROM recipe WHERE recipe_id=:recipe_id";
    $stmt = $conn->prepare($query1);
    $stmt->bindParam(':recipe_id', $recipe_id);
    $stmt->execute();

    $recipe = $stmt->fetch();

    if (!$recipe) die("Failed to find recipe with ID: " . $recipe_id);

    echo '<h1 class="titreRecipe">' . $recipe['recipe_title'] . '</h1>';
    echo '<p class="authorRecipe"> fait par : ' . ucfirst(strtolower($recipe['recipe_author'])) . '</p>';

    //-------------------------------------------------------------------------------- MOYENNE

    $query = 'SELECT AVG(rating) AS average_rating FROM recipe_rating WHERE recipe_id=:id';
    $stmt = $conn->prepare($query);
    $stmt->bindParam('id', $recipe_id);
    $stmt->execute();
    $res = $stmt->fetch();

    if (!$res) {
        die("Failed query: " . $query);
    }


    $averageRating = $res['average_rating'];

    echo '<p class="average">Note moyenne des utilisateurs: <span class="note">' . round($averageRating, 1) . '</span></p>';



    echo "<img class='illustrationRecipe' src='data:image/jpeg;base64," . base64_encode($recipe['recipe_illustration']) . "' >";
    if (isset($_SESSION['username'])) {
        include_once '../etoile/etoile.php';
    }
    $ingredients = explode(', ', $recipe['recipe_ingredient']); // Cela transforme la chaîne en un tableau d'ingrédients
    echo '<ul class="ingredientRecipe">'; // Début de la liste
    foreach($ingredients as $ingredient) { // Parcourez chaque ingrédient
        echo '<li>' . ucfirst(trim($ingredient)) . '</li>'; // Affichez chaque ingrédient avec une majuscule au début dans un élément de liste
    }
    echo '</ul>';

    echo '<p class="descRecipe">' . $recipe['recipe_desc'] . '</p>';
    echo '<h3 class="preparationTitre">Conseil de Préparation :</h3>';
    echo '<p class="preparation">' . $recipe['recipe_instruction'] . '</p>';


    ?>
<script>
    const h1Element = document.querySelector('.titreRecipe');
    const h1Value = h1Element.textContent;
    document.title = h1Value
</script>
</main>
<?php include_once '../footer.inc.php'?>
</body>
