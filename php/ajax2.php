<?php
include 'includes/connexion_db.php';
$db         =connect();
//ancienne synthax:  
//  $query = $db->prepare('SELECT joueur.nom, joueur.prenom, joueur.age, joueur.numero_maillot, joueur.equipe, equipe.nom 
// //     AS equipe_nom
// //     FROM  joueur, equipe
// //     WHERE joueur.equipe = equipe.id');


//INNER= jointure restrictive qui elimine les lignes sans correspondance
// LEFT JOIN = jointures ouvertes incluant les lignes sans correspondance avec l'autre table (null)
$query = $db->prepare('
    SELECT joueur.nom, joueur.prenom, joueur.age, joueur.numero_maillot, joueur.equipe, equipe.nom AS equipe_nom
    FROM  joueur
    LEFT JOIN equipe  
    ON joueur.equipe = equipe.id
    ORDER BY joueur.nom ASC, joueur.age ASC
    ');

$query      -> execute();
$results    =$query ->fetchAll();

// boucle : modif des donnees (1ere lettre en maj) avant envoit au client
for ($i =0; $i< sizeof($results); $i++){
    $results[$i]['nom'] = ucfirst($results[$i]['nom']);
}

echo json_encode($results);


?>