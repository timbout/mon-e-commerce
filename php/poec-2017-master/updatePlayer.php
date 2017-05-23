<?php
include_Once 'includes/connexion_db.php'; // fournit la fonction de connection (connect)
include 'includes/header.php';
include 'includes/menu.php';
include 'includes/equipe.inc.php';

// recuperation de l'id du joueur
if (isset($_GET['id'])) {
    $id= $_GET['id'];

    // etape 1: connection
    $db=connect();

    // etape 2 : requete: le * permet de tout selectionner... sinon: nom, prenom, etc...
    $query = $db->prepare('SELECT * FROM joueur WHERE id= :id');

    // 3eme etape: l'execution:
    $query->execute(array(
        ':id'=> $id
    ));

    // 4 eme etape: le fetch qui permet d'interpreter le SQL par le navigateur
    $joueur = $query->fetch();  // un seul fetch sans while car un seul resultat attendu

  
}

// pour mise a jour de la table joueur an cliquant sur "mettre a jour"
if (isset($_POST['input'])) {
    // le bouton de mise a jour a ete enfoncé:
    // si la connection n'existe pas, on la cree avant la requete.
    if (!isset($db)) $db= connect(); 

    $query= $db->prepare('UPDATE joueur SET prenom=:prenom, nom=:nom, age=:age, numero_maillot=:numero_maillot,  equipe= :equipe 
        where id=:id');

        $query->execute(array(
            ':prenom' =>             $_POST['prenom'],
            ':nom' =>                $_POST['nom'],
            ':age' =>                $_POST['age'],
            ':numero_maillot' =>     $_POST['numero_maillot'],
            ':equipe' =>             $_POST['equipe'],
            ':id' =>                 $_POST['id']
        ));
        // redirection vers la liste des joueur juste apres avoir cliqué sur mettre a jour
        header('location:joueurs.php');
}
?>

<form method="POST">

    <label>Nom</label>
    <input type="text" name="nom" value="<?php echo $joueur['nom'] ?>">

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?php echo $joueur['prenom'] ?>">

    <label>Age</label>
    <input type="text" name="age" value="<?php echo $joueur['age'] ?>">


    <label>Numéro de Maillot</label>
       <!--  <input type="text" name="numero_maillot"> -->
       <select name="numero_maillot">
           <?php
                for ($i=1; $i <1000 ; $i++) { 
                    if($i == $joueur['numero_maillot']) {
                        echo '<option selected value="'.$i.'" > '.$i.' </option>';
                    } else {
                        echo '<option value="'.$i.'" > '.$i.' </option>';
                    }
                }
           ?>
       </select>
       <br>
       <label> Equipe </label>
        <?php 
        echo selectFormatWithOpt(getTeams(), $joueur['equipe']);
        ?>



    <input type="hidden" name="id" value="<?php echo $id ?> "/>

    <input type="submit" name="input" value="Mettre à jour" >




</form>

<?php include 'includes/footer.php'; ?>