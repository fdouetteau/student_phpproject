<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Création</title>
</head>

<body>

<?php

$id_jeu = $_GET["id_jeu"];
$nom_jeu = $_GET["nom_jeu"];
$annee_jeu = $_GET["annee_jeu"];
$prix_jeu = $_GET["prix_jeu"];

// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = "INSERT INTO `projet`.`jeux` (`nom_jeu`, `annee_jeu`, `prix_jeu`) VALUES ('$nom_jeu', '$annee_jeu', '$prix_jeu')";
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

?>

<?php

echo "</form>\n";

// Fermeture de la connexion
mysql_close($link);

?>

<?php
	if($nom_jeu=="$nom_jeu"){
	echo("OK, l'entr&eacute;e a &eacute;t&eacute; cr&eacute;e");
	}
	else{
	echo("KO, l'entr&eacute;e n'a pas &eacute;t&eacute; cr&eacute;e");
	}
?>

<a href="projet_all.php">retour vers la liste des jeux</a>

</body>
</html>
