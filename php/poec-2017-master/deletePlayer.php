<?php
include 'includes/connexion_db.php'; // fournit la fonction de connection (connect)

// recuperation de l'id du joueur
if (isset($_GET['id'])) {
    $id= $_GET['id'];

    // etape 1: connection
    $db=connect();

    // etape 2 : requete
    $query = $db->prepare('DELETE FROM joueur WHERE id= :id'); // attention de bien mettre where sinon ca va supprimer tous les Joueurs !!!!

    // 3eme etape: l'execution:
    $query->execute(array(
        ':id'=> $id
    ));

    // rediriger vers la page joueurs:

    header('location:joueurs.php');
  
}



?>


<?php