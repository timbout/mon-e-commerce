<?php
// detruire la session (deconnexion)
    session_start();
    session_destroy();
    header('location:index.php');
?>
