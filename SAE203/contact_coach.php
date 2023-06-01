<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Coach</title>
    <?php include 'link.inc.php' ?>
    <link rel="stylesheet" type="text/css" href="/assets/css/contact_coach.css">
</head>
<body>
<?php
include_once 'header.inc.php' ?>

<main>


    <form method="post" action="contact_coach.php" class="fieldset-form">

        <h1>PRENDRE RENDEZ-VOUS</h1><p class="texteInfo"><span class="rouge">*</span> = obligatoire</p>

        <label for="nomPrenom">Prénom & Nom<span class="rouge">*</span></label>
        <input type="text" id="nomPrenom" name="nomPrenom" required placeholder="ex : Fabien Romanens"><br>

        <label for="adresseEmail">Adresse Email<span class="rouge">*</span></label>
        <input type="email" id="adresseEmail" name="adresseEmail" required placeholder="ex : toto@gmail.com"><br>

        <label for="numeroTelephone">Numéro de téléphone<span class="rouge">*</span></label>
        <input type="tel" id="numeroTelephone" name="numeroTelephone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="ex : 06 06 06 06 06" inputmode="tel" required><br>
        <fieldset class="grid fieldsetContactCoach">
            <fieldset class="fieldsetContactCoach">
                <label for="cuisine"><b>Spécialité :</b><span class="rouge">*</span></label><br>
                <input type="radio" id="fruitmere" name="cuisine" value="fruitmere" required>
                <label for="fruitmere">Fruit de mère</label><br>

                <input type="radio" id="cuisinelocal" name="cuisine" value="cuisinelocal" required>
                <label for="cuisinelocal">Cuisiner local</label><br>

                <input type="radio" id="cuisinemediterraneenne" name="cuisine" value="cuisinemediterraneenne" required>
                <label for="cuisinemediterraneenne">Cuisine méditerranéenne</label><br>

                <input type="radio" id="barbecue" name="cuisine" value="barbecue" required>
                <label for="barbecue">Barbecue</label><br>

                <input type="radio" id="cuisineinnovante" name="cuisine" value="cuisineinnovante" required>
                <label for="cuisineinnovante">Cuisine innovante</label><br>

                <input type="radio" id="fusionasiatique" name="cuisine" value="fusionasiatique" required>
                <label for="fusionasiatique">Fusion asiatique</label><br>
            </fieldset>

            <fieldset class="fieldsetContactCoach">
                <label for="regime"><b>Régimes :</b></label><br>
                <input type="checkbox" id="vegan" name="regime" value="vegan">
                <label for="vegan">Vegan</label><br>

                <input type="checkbox" id="vegetarien" name="regime" value="vegetarien">
                <label for="vegetarien">Végétarien</label><br>

                <input type="checkbox" id="intolerantlactose" name="regime" value="intolerantlactose">
                <label for="intolerantlactose">Intolérant au lactose</label><br>

                <input type="checkbox" id="allergiearachides" name="regime" value="allergiearachides">
                <label for="allergiearachides">Allergique aux arachides</label><br>

                <input type="checkbox" id="intolerantgluten" name="regime" value="intolerantgluten">
                <label for="intolerantgluten">Intolérant au Gluten</label><br>

                <input type="checkbox" id="autres" name="regime" value="autres">
                <label for="autres">Autres</label></fieldset>
        </fieldset>
        <fieldset class="fieldsetContactCoach">
            <label for="niveau"><b>Niveau :</b><span class="rouge">*</span></label><br>
            <input type="radio" id="debutant" name="niveau" value="debutant">
            <label for="debutant">Débutant</label><br>
            <input type="radio" id="intermediaire" name="niveau" value="intermediaire">
            <label for="intermediaire">Intermédiaire</label><br>
            <input type="radio" id="expert" name="niveau" value="expert">
            <label for="expert">Expert</label><br>
        </fieldset>

        <input type="submit" value="ENVOYER" id="submitCoachForm">


    </form>
</main>
<?php include_once 'footer.inc.php' ?>
</body>
</html>

<?php





if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenomNom = $_POST['nomPrenom'];
    $mail = $_POST['adresseEmail'];
    $phone = $_POST['numeroTelephone'];
    $specialite = $_POST['cuisine'];
    $regime = $_POST['regime'];
    $niveau = $_POST['niveau'];
    $message = "<b>Prise de Rendez-vous</b><br><b>Prénom et Nom :</b> " . $prenomNom . "<br>"
        . "<b>Adresse e-mail :</b> " . $mail . "<br>"
        . "<b>Téléphone :</b> " . $phone . "<br>"
        . "<b>Spécialité :</b> " . $specialite . "<br>"
        . "<b>Régime alimentaire :</b> " . $regime . "<br>"
        . "<b>Niveau :</b> " . $niveau;

    require_once 'config+connexion.php';
    $query = "INSERT INTO mail (mail_from, mail_message, mail_date) VALUES (:mail, :message, CURDATE())";
    try {
        $mail = filter_var(trim($_POST['adresseEmail']), FILTER_SANITIZE_EMAIL);
        $message = trim($message);
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        echo "New record created successfully <br>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
