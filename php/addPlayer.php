<?php
include         'includes/util.inc.php';
include         'includes/equipe.inc.php';
include_once    'includes/access.inc.php';
include         'includes/header.php';
include         'includes/menu.php';


if (isset($_POST['input'])) {
    //echo 'La client a validé le formulaire';

    // 1) connexion
    $db = new PDO('mysql:host=localhost;dbname=formation-poec', 'root', '');

    // 2) requête
    $query = $db->prepare(
        'INSERT INTO joueur (nom, prenom, age, numero_maillot, equipe) VALUES (:nom, :prenom, :age, :numero_maillot, :equipe)');

    // 3) execution
    $query->execute(array(
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':age' => $_POST['age'],
        ':numero_maillot' => $_POST['numero_maillot'],
        ':equipe' => $_POST['equipe']
    ));

    // redirection
    header('location:joueurs.php');
} else {
    //echo 'La client n\'a pas validé le formulaire';
}

?>

<?php
// version 1 avant de creer acces.inc.php
// if (isset($_SESSION['user'])){
//     if ($_SESSION['user']['role']== 'admin' ||  'client') {
        
//     }else{
//         echop('Droits insuffisant');
//     }
//     include 'includes/forms/addplayer.inc.php';
// }else{
//     echop('Vous devez etre connecté pour accéder à cette ressource');
// }

if(isLogged()){
    if (getRole() == 'admin'||'client'){
        
    }else{
        echop('Droits insuffisant');
    }
    include 'includes/forms/addplayer.inc.php';
}else{
    echop('Vous devez etre connecté pour accéder à cette ressource');
}

?>


<?php include 'includes/footer.php'; ?>