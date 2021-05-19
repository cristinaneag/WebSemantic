<?php
require '../vendor/autoload.php';
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");
$client1=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");
$data=file_get_contents("php://input");
$data=json_decode($data,true);
$nume=$data["denumire"];
$pret=$data["pret"];
$categ=$data["categorie"];
$numeNou = str_replace(' ', '', $nume);
$verificare = "prefix : <http://examen.ro#> ASK { <http://examen.ro#$numeNou> ?proprietate ?obiect}";
$rezultat = $client1->query($verificare);
if($rezultat=='true'){
    print "Introduceti o noua denumire";
}else{
$interogare=<<<EOD
@prefix : <http://examen.ro#>.
<http://examen.ro#$numeNou> a :Product;
:hasName '$nume';
:hasPrice $pret;
:hasCategory <$categ>.
EOD;
$grafDeTrimis=new EasyRdf\Graph();
$grafDeTrimis->parse($interogare,"turtle");
$rezultat=$client->insert($grafDeTrimis,"http://examen.ro#grafexamen");
    if(strpos($rezultat, '204')!==false)
        print true;
    else print false;
}
?>