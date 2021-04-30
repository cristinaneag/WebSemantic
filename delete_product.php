<?php
require '../vendor/autoload.php'; 
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");
$produs=$_GET["product"];
$interogare="prefix : <http://examen.ro#> DELETE WHERE { ?produs :hasName '$produs'; :hasPath ?photo; :hasDescription ?description; :hasPrice ?price; :hasCategory ?category; :isAvailable ?available.}";
$result =  $client->update($interogare);
if(strpos($result, '204')!==false)
    print true;
else print false;
?>