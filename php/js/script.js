//alert('ciao');
console.log('js OK');

var list        = document.getElementById('list');
var reset       = document.getElementById('reset');
var ajax        = document.getElementById('ajax');
var message     = "Bonjour à tous";
var nbClics     = 0;


function test() { console.log(message);}

function addLi(){
        if (nbClics < 5){
            var li = document.createElement('li');// createElement génère une balise html
            li.innerText = message;
            list.appendChild(li);
            nbClics++; //  implementation du nbr de click 
        }
}  

function addLi2(text){
        if (nbClics < 5){
            var li = document.createElement('li');
            li.innerText = text;
            list.appendChild(li);
            nbClics++; 
        }
}  
    
function emptyList(){
    // liste.removeChild('li');
    // permet de supprimer tous les ajouts:  list.innerHTML = '';    
    while(list.firstChild){ //tant que la liste a un enfant
        list.removeChild(list.firstChild);
    }
    nbClics =0; //remise a zero du compteur de click
}

function getData(){
    console.log('requete Ajax');
    var url = 'http://localhost/projet/Projet-ecommerce/php/ajax.php';
    var req = new XMLHttpRequest(); // req va recevoir les fonctionnalités implementé dans javascript (ajax)
    req.open('GET', url, false);
    req.send(null); // aucune donnee à renvoyer en base

    if(req.status == 200){
        // instructions a executer en cas de succes
        // console.log('reponse du serveur:' + req.responseText);
        var res = req.responseText;
        console.log(typeof res);// renvoit string (donnée non itérable)
        console.log(res[0]);

        var resArray = JSON.parse(res); //permet de transformer la chaine en tableau
        console.log(resArray);
        console.log(typeof resArray); // renvoit object (structure oblet JS)
        console.log(resArray[0]); // renvoit la valeur de l'indice 0 du tableau

        addLi2(resArray[0]);
    }else {

    }
}

document
    .getElementById('btn')
    .addEventListener('click', addLi);
    // en jquery:  $('btn').click(test);

// ecouteurs d'evenements
reset.addEventListener('click', emptyList);
ajax.addEventListener('click', getData);