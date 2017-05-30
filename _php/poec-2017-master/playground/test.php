<?php
include '../includes/util.inc.php';


// // test de l'extension pour inser de l'image logo
// $extension = substr($_FILES['logo']['name'], -4);
// var_dump($extension);


$name = ' milan AC'; // retour attendu format texte
echo rightFormat($name);



// $str = "benfica-blablabla-coucou.jpg";
// //echo strlen($str); // renvoie 28 

// $len = strlen($str); // 28
// $sub = substr($str, $len-4);
// //echo $sub;

// //echo substr($str, 5, 3);

// echo substr($str, -4);


// for ($i=-1; $i>-6; $i--) {
//     echo '<p>' . substr($str, $i) . '</p>';
// }









?>