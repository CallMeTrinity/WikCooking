<footer>
    <section id="navigation">
        <p id="titreNavigation">Navigation</p>
        <ul>
            <li><a href="/accueil.php">Accueil</a></li>
            <li><a href="/recette.php">Recettes</a></li>
            <li><a href="/a_propos.php">W.I.K Cooking</a></li>
            <?php  if (isset($_SESSION['username'])) {
                echo '<li><a href="/mon_compte.php">Mon compte</a></li>';
            }
            ?>
        </ul>
    </section>

    <section id="reseau">
        <p>Retrouvez-nous sur les <réseaux></réseaux> sociaux :</p>
        <a href="https://www.instagram.com/ii_sarip_ii" target="_blank"><img class="logoReseau" src="/assets/images/instagram.png" alt="reseau instagram"></a>
        <a href="https://www.youtube.com" target="_blank"><img class="logoReseau" src="/assets/images/youtube.png" alt="reseau youtube"></a>
        <a href="https://www.linkedin.com" target="_blank"><img class="logoReseau" src="/assets/images/linkedin.png" alt="reseau linkedin"></a>
    </section>

    <section id="contactfooter">
        <form id="footerform" method="post" action="contact.php">
            <input id="mail" type="email" name="mail" required placeholder="Email">
            <textarea id="message" minlength="3" name="message" maxlength="500" required placeholder="Votre Message"></textarea>
            <input id="btnsubmit" type="submit">
            <input id="btnreset" type="reset">
        </form>
    </section>

    <script src="/assets/js/contact.js"></script>

    <section id="mentionlegale">
        <hr class="separation">
        <p>WIK COOKING &copy; 2023 </p>
    </section>

</footer>