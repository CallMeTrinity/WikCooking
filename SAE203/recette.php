<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes</title>
    <?php include_once 'link.inc.php' ?>
    <link rel="stylesheet" href="/assets/css/recette.css">
</head>
<body>
<?php include_once 'header.inc.php' ?>

<main>
    <!-- fonction de tri ici -->
    <div id="sortingOptions">
        <select id="sortBy" onchange="sortRecipes()">
            <option value="default">Trier par...</option>
            <option value="recipe_title_asc">Titre (Ascendant)</option>
            <option value="recipe_title_desc">Titre (Descendant)</option>
        </select>
    </div>

<div  class="contenu">
    <?php
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = "SELECT * FROM recipe";
    $res = $conn->query($query);
    if (!$res) die("Failed query " . $query);
    $rows = $res->fetchAll();

    foreach ($rows as $row) :
        ?>
            <article class="flip-card" data-title="<?php echo $row['recipe_title']; ?>" id="recipe_<?php echo $row['recipe_id']; ?>">
                <div class="flip-card-front">
                <header class="card_header">
                    <h2><?php echo $row['recipe_title']; ?></h2>
                    <div class="card_img_container">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['recipe_illustration']); ?>"
                             alt="">
                    </div>
                </header>
                <div class="contenu_recette">
                    <?php echo $row['recipe_desc']; ?>
                </div>
                    <a href="/Recipe/recipe1.php?id=<?php echo $row['recipe_id']; ?>" class="btn_flip-card">Voir la recette</a>
                </div>
                <div class="flip-card-back">
                    <?php
                    $ingredients = explode(', ', $row['recipe_ingredient']); // Cela transforme la chaîne en un tableau d'ingrédients

                    echo '<ul>'; // Début de la liste

                    foreach($ingredients as $ingredient) { // Parcourez chaque ingrédient
                        echo '<li>' . ucfirst(trim($ingredient)) . '</li>'; // Affichez chaque ingrédient avec une majuscule au début dans un élément de liste
                    }


                    echo '</ul>'; // Fin de la liste

                    ?>
                    <a href="/Recipe/recipe1.php?id=<?php echo $row['recipe_id']; ?>" class="btn_flip-card">Voir la recette</a>
                </div>

            </article>
    <?php
    endforeach;
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    ?>
</div>
</main>

<?php include_once 'footer.inc.php' ?>

<script src="./assets/js/script.js"></script>

<script>
    function sortRecipes() {
        var sortBy = document.getElementById("sortBy").value;

        var recipes = Array.from(document.getElementsByClassName("flip-card"));

        if(sortBy === "recipe_title_asc") {
            recipes.sort((a, b) => {
                console.log(`Comparing ${a.dataset.title} and ${b.dataset.title}`);
                if (a.dataset.title && b.dataset.title) {
                    return a.dataset.title.localeCompare(b.dataset.title);
                } else {
                    return 0;
                }
            });
        } else if(sortBy === "recipe_title_desc") {
            recipes.sort((a, b) => {
                console.log(`Comparing ${a.dataset.title} and ${b.dataset.title}`);
                if (a.dataset.title && b.dataset.title) {
                    return b.dataset.title.localeCompare(a.dataset.title);
                } else {
                    return 0;
                }
            });
        }
        console.log(`Number of recipes after sorting/filtering: ${recipes.length}`);

        var mainContent = document.getElementsByClassName("contenu")[0];

        // Clear main content and re-append sorted/filtered recipes
        mainContent.innerHTML = '';
        recipes.forEach(recipe => mainContent.appendChild(recipe));
    }
</script>



</body>
</html>
