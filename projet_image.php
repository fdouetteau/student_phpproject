<?php
include('functions.php'); 
connect(); 

$query = 'SELECT * FROM image WHERE jeu_id='.$_GET['jeu_id'];
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$image_jeu = $line['image_contenu'];
header("Content-type: image/jpeg");
print $image_jeu;	
?>