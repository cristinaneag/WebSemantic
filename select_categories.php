<?php
require '../vendor/autoload.php'; 
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");
$interogare="prefix : <http://examen.ro#> SELECT ?categorie ?nume WHERE {?categorie :hasName ?nume; a :Category}  ORDER BY ?nume";
$rezultate=$client->query($interogare);
$dateTrimis = [];
foreach ($rezultate as $rezultat)
{
    $dateTrimis["$rezultat->categorie"]="$rezultat->nume";
}
$dateSerializate=json_encode($dateTrimis);
print $dateSerializate;
?>