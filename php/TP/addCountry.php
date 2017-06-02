<?php

include 'includes/connect_db.php';

//connexion
$db = connect(); 

//requete:
$query = $db-> prepare('
    INSERT INTO country (country, capitale, nombre_habitants, superficie, langues) 
    VALUES (:country, :capitale, :nombre_habitants, :superficie, :langues)
');

// 3) execution (on cree la variable result ... pour voir ce qui a ete envoyé)
$result = $query -> execute(array(
    ':country' => $_POST['country'],
    ':capitale' => $_POST['capitale'],
    ':nombre_habitants' => $_POST['nombre_habitants'],
    ':superficie' => $_POST['superficie'],
    ':langues' => $_POST['langues']
));

echo $result; // on envoi le resultat de la requete sql (booleen) au client.



?>
