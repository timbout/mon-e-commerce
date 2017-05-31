

var players =null; //source de données globale (accessible hors fonction)

function getPlayers(){
    var url = 'http://localhost/projet/Projet-ecommerce/php/ajax2.php';
    console.log (players);
    //requete Ajax ASNchrone donc JS n'attend pas la reponse serveur pour continuer l'exé du script
    $.get(url, function(data) {
        //data contiendra les données envoyées par le serveur
        // console.log(data);
        players = JSON.parse(data);
        displayTable (players); // fonction responsable de l'affichage du tableau des joueurs
        
        $('#ageHeader').on('click', function() {  
        });
    });
}

function displayTable(players){
    var table ='<table class= "table table-striped">';
    //entete
    table+='<tr><th>Nom</th><th>Prénom</th><th id="ageHeader">Âge</th><th>Numéro</th><th>Equipe</th></tr>';

    //boucle
    players.forEach(function(player){
    table+= '<tr>';
    table+= '<td>' + player.nom + '</td>';
    table+= '<td>' + player.prenom + '</td>';
    table+= '<td>' + player.age + '</td>';
    table+= '<td>' + player.numero_maillot + '</td>';

    if(player.equipe_nom == null){
        table+= '<td> SCF </td>';
    }else{
        table+= '<td>' + player.equipe_nom + '</td>';
    } 

    table+= '</tr>';

    });

    table+= '<table>';
    $('#listPlayers').html(table); // injecte dans la table
}


function hidePlayers(ageLimit){
    var nbResults = 0;
    var rows = $('table tr');//on recupere les lignes du tableau
    $.each(rows, function(index, row){
        // on re-cible la ligne avec Zepto afin de doter l'element ciblé (row) de nouvelles capacités.
         var r= $(row); //r est plus fournit en fonctionnalité que Row
         var age = r.children().eq(2).text();
            if (age > ageLimit && index != 0){
                r.hide();
            }else{
                r.show();
                nbResults++;// on incremente la variable a chaque boucle
            }
    });
    $('#nbResults').html(nbResults-1);//on affiche le resultat dans le DOM -1 pour pas prendre l'en tete.
}


getPlayers(); //appel de la fonction au chargement du script.

$('#selectAge').on('change', function(){
    var age = $(this).val(); // recupere la valeur du selectAge (this c'est la balise et val la valeur)
    hidePlayers(age);
});

var notes = [7, 56, 12, 74, 30];
var max = _.max(notes);
var min = _.min(notes);

console.log(max);
console.log(min);


