<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$id_jeu=$_GET["id_jeu"];
$query = 'SELECT image_jeu FROM jeux WHERE id_jeu='.$id_jeu;
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$image_jeu = $line['image_jeu'];
header("Content-type: image/jpeg");
print $image_jeu;
exit;

?>