<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Propos</title>
    <?php include_once 'link.inc.php'?>
    <link rel="stylesheet" href="./assets/css/a_propos.css">
</head>
<body>
<?php
include_once 'header.inc.php' ?>
<div class="cuisinierdiv">
    <img src="/assets/images/antoninDeboutCuisto.png" class="cuisinier">
    <img src="/assets/images/parisDeboutCuisto.png" class="cuisinier">
</div>
<main>

    <p>Bienvenue sur le site de cuisine loufoque, créé en 2023 par deux esprits culinaires passionnés : Pâris Gougne et
        Antonin Pamart. Laissez-nous vous présenter ces deux compères excentriques qui ont décidé de mettre leurs
        talents au service de la gastronomie délirante !</p><br>

    <p>D'un côté, nous avons Pâris Gougne, un véritable as de la création culinaire. Avec son esprit inventif et son
        imagination débordante, il transforme les ingrédients les plus improbables en délices surprenants. Nul besoin de
        préciser que Pâris n'a pas suivi d'école de cuisine traditionnelle. Sa formation ? Des années d'expérimentation
        audacieuse dans sa cuisine personnelle. En fait, ses amis pensent souvent qu'il est plus proche du savant fou
        que du chef cuisinier !</p><br>

    <p>De l'autre côté, nous avons Antonin Pamart, l'expert en goût et en présentation. Antonin a un talent inné pour
        marier les saveurs et sublimer les plats. Sa passion pour la cuisine l'a poussé à explorer différentes cultures
        gastronomiques, des mets traditionnels aux expériences culinaires les plus exotiques. Tout comme Pâris, il n'a
        pas fréquenté les bancs d'une école de cuisine réputée, mais il a toujours suivi son palais affûté pour créer
        des créations gustatives uniques.</p><br>

    <p>Lorsqu'ils ont croisé leurs chemins, Pâris et Antonin ont immédiatement réalisé qu'ils partageaient une passion
        commune : la cuisine. Ils ont décidé de créer le site de cuisine loufoque pour transmettre leur amour de la
        gastronomie à un large public. Leur objectif est simple : partager des recettes savoureuses et insolites avec
        tous les amateurs de cuisine, des novices aux experts.</p><br>

    <p>Bien que n'ayant pas suivi de formation académique, Pâris et Antonin savent que la passion est plus importante
        que l'expérience, du moins la plupart du temps. Leur approche ludique et créative de la cuisine permet de
        repousser les limites de la gastronomie conventionnelle et d'explorer de nouvelles saveurs avec audace. Ils
        croient fermement que la cuisine est une forme d'expression artistique qui ne devrait pas être limitée par des
        règles strictes.</p><br>

    <p>Sur le site de cuisine loufoque, vous découvrirez des recettes étonnantes et délicieuses, accompagnées
        d'histoires rocambolesques sur leur création. Des gâteaux en forme d'extraterrestres aux pizzas sucrées en
        passant par des soupes aux couleurs extravagantes, Pâris et Antonin vous invitent à un voyage culinaire déjanté
        et plein de surprises.</p><br>

    <p>Alors, préparez votre tablier, sortez vos ustensiles de cuisine et rejoignez Pâris et Antonin dans leur univers
        culinaire loufoque. Parce que, parfois, les meilleures recettes sont créées par des passionnés audacieux qui
        osent explorer de nouveaux horizons gastronomiques !</p>


</main>

<aside class="commentaire">
    <?php include 'config+connexion.php';


    ?>


    <?php echo "<hr>";
    echo "<form method='post' action='a_propos.php' id='commentForm'>";
    if (!isset($_SESSION['username'])) {
        echo '<input type="email" name="email" placeholder="Adresse Email">';
    }
    echo '<input type="text" name="comment" placeholder="Votre Commentaire">';
    echo "<input type='submit' value='Poster le commentaire' name='sendComment' id='submitComment'>";
    echo '</form>';


    if (isset($_POST['sendComment'])) {
        $message = $_POST['comment'];
        $query = "INSERT INTO comment (comment_author, comment_text) VALUES (:author, :message)";
        if (isset($_POST['email'])){
            $author = $_POST['email'];
        }else {
            $author = $_SESSION['username'];
        }
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    echo '<div class="comments">';
    $sql = "SELECT * FROM comment ORDER BY comment_id desc LIMIT 8 ";
    $res = $conn->query($sql);
        if (!$res) die("Failed query " . $sql);
        foreach ($res as $row) {
    ?>
    <div class="comment">
        <div class="commentAuthor"><p><?php echo $row['comment_author'] ?></p></div><hr>
        <div class="commentContent"><p><?php echo $row['comment_text']; ?></p></div>
    </div>
    <?php } ?> </div>
</aside>





<?php
include_once 'footer.inc.php'
?>
</body>
</html>
