<?php
//include 'includes/connexion_db.php';
include 'includes/equipe.inc.php';
include 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_POST['input'])) {
    //echo 'La client a validé le formulaire';

    // 1) connexion mais mis sur la page connexio_db.php
    // $db = new PDO('mysql:host=localhost;dbname=formation-poec', 'root', '');
    $db = connect();

    // 2) requête
    $query = $db-> prepare('
        INSERT INTO equipe (nom, entraineur, couleurs) VALUES (:nom, :entraineur, :couleurs            
        )');

    // 3) execution
    $query->execute(array(
        ':nom' =>            $_POST['nom'],
        ':entraineur' =>     $_POST['entraineur'],
        ':couleurs' =>        $_POST['couleurs'],
        
    ));

    header('location:joueurs.php'); // redirection vers la page joueurs

} else {
    //echo 'La client n\'a pas validé le formulaire';
}

// chargement des équipes


?>

<h1>Enregistrer une équipe</h1>

<div class ="containeur">

    <form method="POST">

        <div class="row">
            <div class= "col-md-3">
                <label>Nom</label>
                <input type="text" name="nom">
            </div>

            <div class= "col-md-3">
                <label>entraineur</label>
                <input type="text" name="entraineur">
            </div>
            <div class= "col-md-3">
                <label>couleurs</label>
                <input type="text" name="couleurs">
            </div>
        </div>

        <br>

        
        <div class="row">
            <div class= "col-md-12"> 
                <input type="submit" name="input" value="Enregistrer">
            </div>
        
    </form>
</div>

<?php include 'includes/footer.php'; ?>