<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <?php include_once 'link.inc.php' ?>
    <link rel="stylesheet" href="/assets/css/accueil.css">
</head>
<body>
<?php include_once 'header.inc.php' ?>

<main>

    <div class=" recipe-cards">
        <?php include_once 'config+connexion.php';
        $query = "SELECT * FROM recipe ORDER BY RAND() LIMIT 3";
        $res = $conn->query($query);
        if (!$res) die("Failed query " . $query);
        $rows = $res->fetchAll();

        foreach ($rows as $row) :

            ?>
            <a href="/Recipe/recipe1.php?id=<?php echo $row['recipe_id']; ?>" class="btn_flip-card">
                <div class="card">

                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['recipe_illustration']); ?>">
                    <h2> <?php echo $row['recipe_title'] ?></h2>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<div class="coach-cards">
    <a id="paris-card" href="/coach_paris_details.php" class="btn btn-primary">
        <div class="coach-card">
            <h2>Coach Pâris</h2>
            <img src="/assets/images/pariscuisto.png" alt="Image de Coach Pâris">
            <ul>
                <li>Expert en fruits de mer</li>
                <li>Aime utiliser des ingrédients locaux et de saison</li>
                <li>Spécialisé dans la cuisine méditerranéenne</li>
            </ul>

        </div></a>
    <a id="anto-card" href="/coach_antonin_details.php" class="btn btn-primary">
        <div class="coach-card">
            <h2>Coach Antonin</h2>
            <img src="/assets/images/antocuisto.png" alt="Image de Coach Antonin">
            <ul>
                <li>Maître du barbecue</li>
                <li>Utilise des techniques de cuisine innovantes</li>
                <li>Passionné de cuisine fusion asiatique</li>
            </ul>
        </div></a>
</div>


<div class="login-signup-link">
    <a href="compte.php">Se connecter</a> ou <a href="compte.php?show=signup">Inscription</a>
</div>
</main>



<?php include_once 'footer.inc.php' ?>
<script src="/assets/js/accueil.js"></script>


</body>
</html>
