<?php

$query = "SELECT * FROM user";
$res = $conn->query($query);
if (!$res) die("Failed query " . $query);


echo "<p class='presentation'>Vous êtes admin : voici les tables : </p><br>";
?>

<table>
    <thead>
    <tr>
        <th>
            user_login
        </th>
    </tr>

    </thead>
</table>

<?php


foreach ($res as $row) {
    echo "<tr>";
    echo "<td>";
    echo "<p> " . $row['user_num'] . " </p>";
    echo "</td>";
    echo "<td>";
    echo "<p> " . $row['user_login'] . " </p>";
    echo "</td>";
    echo "<td>";
    echo "<p> " . $row['user_password'] . " </p>";
    echo "</td>";
    echo "<td>";
    echo "<p> " . $row['user_email'] . " </p>";
    echo "</td>";
    echo "<td>";
    echo "<p> " . $row['user_role'] . " </p>";
    echo "</td>";
    echo "</tr>";

}
echo "</table>;";