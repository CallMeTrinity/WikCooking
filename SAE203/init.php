<?php
require 'config+connexion.php';

// Liste des fichiers SQL
$fichiers_sql = [

    'database/wikDB_comment.sql',
    'database/wikDB_mail.sql',
    'database/wikDB_recipe.sql',
    'database/wikDB_user.sql',
    'database/wikDB_recipe_rating.sql'
];

// Liste des noms de table correspondants
$tables = [

    'wikDB.comment',
    'wikDB.mail',
    'wikDB.recipe',
    'wikDB.user',
    'wikDB.recipe_rating'
];

// Pour chaque fichier SQL
for ($i = 0; $i < count($fichiers_sql); $i++) {
    // Tronquer la table
    $sql = "TRUNCATE TABLE " . $tables[$i] . ";";
    $conn->exec($sql);

    // Remplir la table
    $sql = file_get_contents($fichiers_sql[$i]);
    try {
        $conn->exec($sql);
        echo "Table " . $tables[$i] . " réinitialisée avec succès à partir du fichier : " . $fichiers_sql[$i] . "<br>";
    } catch (PDOException $e) {
        echo "Erreur lors de la réinitialisation de la table " . $tables[$i] . " à partir du fichier : " . $fichiers_sql[$i];
        echo "<br>Error: " . $e->getMessage();
    }
}

header('Location: mon_compte.php');
exit;

?>

