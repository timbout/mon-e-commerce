<?php
    include_once 'includes/access.inc.php';
    
$menus = [
    ['href' => 'index.php', 'label' => 'Accueil'],
    ['href' => 'variables.php', 'label' => 'Variables'],
    ['href' => 'boucles.php', 'label' => 'Boucles'],
    ['href' => 'fonctions.php', 'label' => 'Fonctions'],
    ['href' => 'get.php?country=maroc&sport=football', 'label' => 'GET'],
    ['href' => 'joueurs.php', 'label' => 'Joueurs'],
    ['href' => 'equipes.php', 'label' => 'Equipes'],

    ['href' => 'addPlayer.php', 'label' => 'Ajouter un joueur'],
    
    ['href' => 'addTeam.php', 'label' => 'Ajouter une équipe']

];
?>
<nav>
    <ul class="list-inline">
    <?php foreach ($menus as $menu): ?>
        <li>
            <a href="<?php echo $menu['href']; ?>">
                <?php echo $menu['label']; ?>  
            </a>
        </li>   

    <?php endforeach ?>
    
        <?php
        // isset permet de dire si il n'y a pas la cle, ne pas essayer de faire la fonction
            if(isLogged()){
                echo '<li><a href="logout.php"> Déconnexion </a></li>';
            }

            
        ?>    
    </ul>
</nav>