<?php
include 'includes/util.inc.php';
include_Once 'includes/equipe.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_GET['ageLimit'])) {
    $ageLimit = $_GET['ageLimit'];

    if (strlen($ageLimit) > 2) {
        $ageLimit = 35;
    }
}

$db = new PDO('mysql:host=localhost;dbname=formation-poec', 'root', '');

if (isset($ageLimit)) {
    $query = $db->prepare('SELECT * FROM joueur WHERE age < ' . $ageLimit);
} else {
     $query = $db->prepare('SELECT * FROM joueur');
}

$query->execute(); 

?>

<h1>Joueurs</h1>


<div>
    <form>
        <label>Limite d'âge</label>
        <select name="ageLimit">
            <option value="20">20 ans</option>
            <option value="25">25 ans</option>
            <option value="30">30 ans</option>
            <option value="35">35 ans</option> 
        </select>
        <input type="submit" value="Valider">
    </form>
</div>

<?php
   

  $i=0;

  $output =''; // j'initialise une variable vide de stockage output qui recevra les resultats
  $i= 0;

  while ($joueur = $query->fetch()) {
    $i++;    

    $condition= 
      $joueur['numero_maillot']>0 &&
      $joueur['numero_maillot'] <1000;


      if ($condition) {
        $output .= '<p>' . $joueur['prenom'] . ' ' . $joueur['nom']. ' '. '(' . $joueur['numero_maillot'] . ')' ; // le .= permet de ne pas ecraser les resultats precedents. 

      } else {
         $output .='<p>'.$joueur['prenom'] . ' ' .$joueur['nom'];
      }

      $team = getTeamById($joueur['equipe']);
        if ($team == false){
          $output .= ', SCF';

        }else {
          $output .=', equipe : '. $team['nom'];
        }

      
      
      $output .= ' <a class="btn-primary btn-xs" 
      href="updatePlayer.php?id='.$joueur['id'].'"> Modifier </a>';

      $output .= ' | ';

      $output .= ' <a class="btn-danger btn-xs"
      href="deletePlayer.php?id='.$joueur['id'].'"> Supprimer </a>';

      $output .='</p>';
   
    }

    echo '<p> Nombre de résultats : ' .$i.' </p>';
    echo '<br>';
    echo $output;
?>


<?php include 'includes/footer.php'; ?>