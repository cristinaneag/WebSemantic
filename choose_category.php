<?php
error_reporting(0);
require '../vendor/autoload.php'; 
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");
$category=$_GET["item"];
$interogare="prefix : <http://examen.ro#> 
SELECT  ?product ?nume ?photo ?description ?price ?isAvailable 
WHERE {
  ?product a :Product; :hasName ?nume;  :hasPrice ?price; :hasCategory/:hasName '$category';
    OPTIONAL {?product :hasPath ?photo}
  OPTIONAL {?product :hasDescription ?description}
  OPTIONAL {?product :isAvailable ?isAvailable}
}  ORDER BY ?nume";
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
$dateSerializate=json_encode($dateTrimis);
print $dateSerializate;
?>