<?php
function getCountries() {
    $db = connect();
    $query = $db->prepare('SELECT * FROM country');
    $query->execute();
    return $query->fetchAll();
    console.log(getCountries);
}



?>