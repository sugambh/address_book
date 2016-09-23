<?php

$xml = new SimpleXMLElement('<xml/>');
include('connection.php');
$result = $db->query("SELECT * FROM contacts");
foreach($result as $row)
{
	$contact = $xml->addChild('contact');
    $contact->addChild('name',$row['']);
    $contact->addChild('first_name',$row['first_name']);
    $contact->addChild('street',$row['street']);
    $contact->addChild('zip_code',$row['zip_code']);
                         $city_sql= "SELECT * FROM cities WHERE id = ".$row['city']; 
                         $stmt = $db->query($city_sql); 
                         $city_row = $stmt->fetch(PDO::FETCH_ASSOC);
    $contact->addChild('city',$city_row['name']);
}

Header('Content-type: text/xml');
print($xml->asXML());

?>