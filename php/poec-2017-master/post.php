<?php
// session_start(); // ouvre ou reprend une session

include 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

// var_dump($_SESSION);//renvoit null si aucune session ouverte, sinon renvoit un tableau associatif (potentionnellement vide)

// $_SESSION ['test'] = 'ca marche !';
// var_dump($_SESSION);
?>

<h1>POST</h1>

<?php

// print_r($_POST);

$email = $_POST['email'];
$pass = $_POST['pass'];

if (isset($_POST['admin'])) {
    $admin = $_POST['admin'];
}
/*$test = null;
if (isset($test)) {
    echop("La variabel test est définie");
} else {
    echop("La variabel test n'est pas définie");
}*/
if ($email == "test@test.fr" && $pass == 1234 && isset($admin)) {
    echop("Identification réussie...");


    //enregistre l'etat loggé dans la session
    $_SESSION['logged'] = true;
    header('location:index.php');
} else {
    echop("L'identification a échoué...");
}


?>

<?php include 'includes/footer.php'; ?>