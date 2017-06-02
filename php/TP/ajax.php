<?php
include 'includes/connect_db.php';
$db = connect();

$query = $db->prepare('
    SELECT country.country, country.capitale, country.nombre_habitants, country.langues
    FROM  country
    ORDER BY country.country ASC
    ');

$query -> execute();
$results = $query ->fetchAll();

echo json_encode($results);

console.log ($results);
?>