<?php
require '../vendor/autoload.php'; 
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");
$category=$_GET["item"];
$interogare="prefix : <http://examen.ro#> SELECT  ?product ?nume ?photo ?description ?price ?isAvailable WHERE {?product a :Product; :hasName ?nume; :hasPath ?photo; :hasDescription ?description; :hasPrice ?price; :hasCategory/:hasName '$category'; :isAvailable ?isAvailable }  ORDER BY ?nume";
$rezultate=$client->query($interogare);
$dateTrimis = [];
foreach ($rezultate as $rezultat)
{
    $dateTrimis["$rezultat->product"]=array(
        "nume"=>"$rezultat->nume",
        "photo"=>"$rezultat->photo",
        "description"=>"$rezultat->description",
        "price"=>"$rezultat->price",
        "stoc"=>"$rezultat->isAvailable");
}
//$dateTrimis["categorie"]=$category;
$dateSerializate=json_encode($dateTrimis);
print $dateSerializate;
?>