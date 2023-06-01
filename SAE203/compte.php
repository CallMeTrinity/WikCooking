<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/connexion.css">
</head>
<body>
<?php include_once 'header.inc.php' ?>

<main>
    <div class="flip-card">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <div class="container">
                    <form action="compte_gestion.php" method="post" id="connexion">
                        <label class="block" for="username">Nom d'utilisateur ou Adresse mail :</label>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur / Email"
                               required autocomplete="">
                        <label for="password" class="block">Mot de passe :</label>
                        <input type="password" id="password" name="password" placeholder="Mot de Passe" required>

                        <input type="submit" value="Se connecter">
                        <button type="button" name="flip" class="flip">Vous êtes nouveau ?</button>
                    </form>
                    <div id="error-message"></div>

                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $('#connexion').on('submit', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url: 'compte_gestion.php', // Le script PHP qui gère la connexion
                                    type: 'POST',
                                    data: $(this).serialize(),
                                    success: function (data) {
                                        if (data.error) {
                                            $('#error-message').text(data.message);
                                        } else {
                                            window.location.href = 'mon_compte.php'; // Redirige vers mon_compte.php si la connexion réussit
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="flip-card-back">
                <div class="container">
                    <form action="compte_gestion.php" method="post" id="inscription">
                        <label class="block" for="username">Nom d'utilisateur :</label>
                        <input type="text" id="usernameSignUp" name="usernameSignUp" placeholder="Nom d'utilisateur"
                               required>
                        <span id="username_error"></span>

                        <label class="block" for="mail">Adresse email :</label>
                        <input type="email" name="mailSignUp" placeholder="Email" id="mailSignUp" required>
                        <label for="password" class="block">Mot de passe :</label>
                        <input type="password" id="passwordSignUp" name="passwordSignUp" placeholder="Mot de Passe"
                               required>

                        <input type="submit" value="S'inscrire">
                        <button type="button" name="flip" class="flip">Déjà incrit ?</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include_once 'footer.inc.php' ?>
<script src="./assets/js/connexion.js"></script>
<script>
    $(document).ready(function() {
        $('#usernameSignUp').blur(function() {
            var usernameSignUp = $(this).val();

            $.ajax({
                url: 'check_username.php',
                method: 'POST',
                data: {usernameSignUp:usernameSignUp},
                success: function(data) {
                    $('#username_error').html(data);
                }
            });
        });

        var url = new URL(window.location.href);
        var show = url.searchParams.get("show");
        if (show === "signup") {
            $('.flip-card-inner').toggleClass('active');
        }
    });

</script>

</body>
</html>






