//********* VARIABLES GLOBALES************

var players = null; //source de données globale (accessible hors fonction)
var ageAsc = false; // permet de savoir si les joueurs sont tries par age ascendant
var nomAsc = true;
var filterAge = null;
//***************************************

//**********FONCTIONS**********************
function getPlayers(){
    var url = 'http://localhost/projet/Projet-ecommerce/php/ajax2.php';
    console.log (players);
    //requete Ajax ASNchrone donc JS n'attend pas la reponse serveur pour continuer l'exé du script
    $.get(url, function(data) {
        //data contiendra les données envoyées par le serveur
        // console.log(data);
        players = JSON.parse(data);
        displayTable (players); // fonction responsable de l'affichage du tableau des joueurs
    });
}

function displayTable(players){
    var table ='<table class= "table table-striped">';
    //entete
    table+='<tr><th id = nomHeader>Nom</th><th>Prénom</th><th id="ageHeader">Âge</th><th>Numéro</th><th>Equipe</th></tr>';

    var oldest = _.max(getAges(players)); //recupere l'age le + elevé dans getAge
    console.log(oldest);

    //boucle
    players.forEach(function(player){
    table+= '<tr>';
    table+= '<td>' + player.nom + '</td>';
    table+= '<td>' + player.prenom + '</td>';

    if(player.age == oldest){
        table+= '<td class ="oldest">' + player.age + '</td>';
    }else{
        table+= '<td>' + player.age + '</td>';
    }

    

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

function getAges(players){
    var ages= []; // on initialise un tableau vide
    players.forEach(function(player){
        ages.push(player.age);// permet a chaque passage d'ajouter un element dans le tableau
    });
    return ages;// retourne le tableau des ages
}

function getFormValues(form){
 //recupere tous les inputs placés dans le formulaire fourni en entré
    var inputs = form.children('input');

    //recupere la valeur du 1er input trouvé (nom)
    var nom         = inputs.eq(0).val();
    var prenom      = inputs.eq(1).val();
    var age         = inputs.eq(2).val();

    //renvoit un tableau avec les deux balises selects
    var selects     = form.children('select');
    var maillot     = selects.eq(0).val();
    var equipe      = selects.eq(1).val();

    // console.log(nom + ' ' + prenom +''+ maillot);
    // creation d'un objet values
    //values permettant d'nregistrer et stocker tt les données à transmettre au serveur
    values = {
        nom: nom,
        prenom: prenom,
        age: age,
        maillot: maillot,
        equipe: equipe,
    };
    return values;
}

function checkValues(player){
    //player est ici un objet
    var conditions = 
    player.nom.length > 1 && 
    player.prenom.length > 1 &&
    player.age.length >1;

    return conditions;
}

function clearMessage(timer){
    var message = $('#message');
    setTimeout(function (){
        message.text(''). removeClass();// efface le texte et le CSS situé dans l'element id 'message' (le span)
    }, timer);
}

//******************************************

//********* ECOUTEURS d EVENEMENTS **********

//lorsque l'element #ageHeader EXISTERA dans le dom, JS placera un ecouteur d'evenement 'click' dessus.
$(document).on('click', '#ageHeader', function(){ 
    if (ageAsc) {
        var sortedPlayers = _.reverse(_.sortBy(players,['age']));// renverse le tri
    }else{
        var sortedPlayers = _.sortBy(players,['age']);
    }
    ageAsc = !ageAsc;// true devient false ou False devient True.
    displayTable(sortedPlayers);

    if(filterAge){ // si variable filterAge est different de null
        hidePlayers(filterAge); //alors on masque les joueurs dons la valeur est supperieure à filterAge
    }
});

$(document).on('click', '#nomHeader', function(){ 
    if (nomAsc) {
        var sortedPlayers = _.reverse(_.sortBy(players,['nom']));// renverse le tri
    }else{
        var sortedPlayers = _.sortBy(players,['nom']);
    }
    nomAsc = !nomAsc;// true devient false ou False devient True.
    displayTable(sortedPlayers);

    if(filterAge){ // si variable filterAge est different de null
        hidePlayers(filterAge);
    }
});

$('#displayFormPlayer').on('click', function(){
    var text = ' le formulaire pour ajouter un joueur';
    // $('#formPlayer').show();  permet de montrer le formulaire quand formPlayer est clické
    var form = $(this).next();// cible this (la valeur du click) et va faire afficher (toogle) dans next (la balise suivante donc la div)le formulaire
    form.toggle(); // reproduit la fonction au dessus mais plus rapide pour le client.
    
    //changer le text du lien en fonction de la visibilité du formulaire
    var status = form.css('display'); // donne none ou block
    if (status== 'none'){
        $(this).text ('Afficher' + text);
    }else{
        $(this).text ('Masquer' + text);
    }
});

$('#formPlayer button').on('click', function(){
    var form = $('#formPlayer');
    var player = getFormValues(form);
    var check = checkValues(player);
    console.log(check);

    if (check){//di conditions remplies => requete Ajax en post
        var url = 'http://localhost/projet/Projet-ecommerce/php/ajaxAddPlayer.php'; 
        $.post(url, player, function(data){
            // si php a renvoyé un succes (1) de la requete sql (envoit des donnés)
            if (data == 1) {
                getPlayers(); //rafraichi la liste des joueurs
                $('#message')
                    .text('l\'enregistrement a reussi')
                    .removeClass()
                    .addClass('bg-success text-success');
            }else{
                $('#message')
                .text('l\'enregistrement a échoué')
                .removeClass()
                .addClass('bg-danger text-danger');
            }
        });
    }else{// afficher message d'erreur si conditions de validation non remplies
        $('#message')
            .text('formulaire non valide')
            .removeClass()
            .addClass('bg-danger text-danger')
    }  
    clearMessage(5000);// appel la fonction cleaMessage en fonction du timer.
});

$('#selectAge').on('change', function(){
    filterAge = $(this).val(); // recupere la valeur du selectAge (this c'est la balise et val la valeur)
    hidePlayers(filterAge);
});

//*********************************************

// *********** TRAITEMENT COTE CLIENT***********

getPlayers(); //appel de la fonction au chargement du script, chargement de la liste des joueurs.

