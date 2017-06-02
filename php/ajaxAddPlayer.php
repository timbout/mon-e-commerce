<?php

include 'includes/connexion_db.php';

//connexion
$db = connect(); 

//requete:
$query = $db-> prepare('
    INSERT INTO joueur (nom, prenom, age, numero_maillot, equipe) 
    VALUES (:nom, :prenom, :age, :numero_maillot, :equipe)
');

// 3) execution (on cree la variable result ... pour voir ce qui a ete envoyé)
$result = $query -> execute(array(
    ':nom' => $_POST['nom'],
    ':prenom' => $_POST['prenom'],
    ':age' => $_POST['age'],
    ':numero_maillot' => $_POST['maillot'],
    ':equipe' => $_POST['equipe']
));

echo $result; // on envoi le resultat de la requete sql (booleen) au client.



?>


