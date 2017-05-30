function test(){
    console.log('zepto fonctionne');
}


function getPlayers(){
    var url = 'http://localhost/projet/Projet%20e%20commerce/php/poec-2017-master/ajax2.php';
    $.get(url, function(data) {
        //data contiendra les données envoyées par le serveur
        // console.log(data);
        var players = JSON.parse(data);
        displayTable (players); // fonction responsable de l'affichage du tableau des joueurs
        
        });
}

function displayTable(players){
    var table ='<table class= "table table-striped">';
    //entete
    table+='<tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Numéro</th></tr>';

    //boucle
    players.forEach(function(player){
    table+= '<tr>';
    table+= '<td>' + player.nom + '</td>';
    table+= '<td>' + player.prenom + '</td>';
    table+= '<td>' + player.nom + '</td>';
    table+= '<td>' + player.numero_maillot + '</td>';
    table+= '</tr>';

    });

    table+= '<table>';
    $('#listPlayers').html(table);
}

$('#btn').on('click', test);
getPlayers(); //appel de la fonction au chargement du script.