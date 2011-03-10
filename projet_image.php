<?php
// là c'est pour afficher une image
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('mariececilehuet-projet') or die('Impossible de sélectionner la base de données');

$query = 'SELECT * FROM image WHERE jeu_id='.$_GET['jeu_id'];
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$image_jeu = $line['image_contenu'];
header("Content-type: image/jpeg");
print $image_jeu;	
exit;
?>