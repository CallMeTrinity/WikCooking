<?php  session_start(); ?>
<script src="/lib/jquery.js"></script>

<header id="header">
    <a href="/accueil.php">
        <section class="logo">
            <img src="/assets/images/logo.png" alt="">
            <span>W.I.K Cooking</span>
        </section>
    </a>
    <nav class="menu" id="mobile-menu">
        <ul>
            <li><a href="/accueil.php">Accueil</a></li>
            <li><a href="/recette.php">Recettes</a></li>
            <li><a href="/a_propos.php">W.I.K Cooking</a></li>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<li><a href="/logout.php">Déconnecter '.$_SESSION['username'].' </a></li>';
            }
            ?>
        </ul>
    </nav>
    <div id="hamburger-icon">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <section class="compte">

        <a href="<?php
        if (isset($_SESSION['username'])) {
            echo '/mon_compte.php';
        } else {
            echo '/compte.php';
        } ?>"><img src="/assets/images/compte.png" alt="création de compte"></a>

    </section>


</header>

<script>
    document.getElementById("hamburger-icon").addEventListener("click", function() {
        var menu = document.querySelector("#mobile-menu");
        var icon = document.getElementById("hamburger-icon");
        if (menu.style.display === "none") {
            menu.style.display = "block";
            icon.classList.add("open"); // Add the animation
        } else {
            menu.style.display = "none";
            icon.classList.remove("open"); // Remove the animation
        }
    });



</script>