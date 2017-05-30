<?php
include 'includes/util.inc.php';
include 'includes/connexion_db.php';
include 'includes/header.php';
include 'includes/menu.php';


    if(isset($_POST['email']) && isset($_POST['pass'])) {
       $email = $_POST['email'];
       $pass = $_POST['pass'];
// connexion a MySql: requete et execution
       $db= connect();
       $query = $db -> prepare('SELECT * FROM users WHERE email = :email AND password = :password');
       $query -> execute (array(
            ':email' => $email, 
            ':password' => $pass
        ));

        $result = $query ->fetch();

        if($result){
            // on enregistre l'utilisateur dans la session
            $_SESSION['user'] = $result;
            header('location:index.php');

        
        }else{
        echop('utilisateur non reconnu');
        }
    }
?>

<?php include 'includes/footer.php'; ?>