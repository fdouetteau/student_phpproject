<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Création</title>
</head>

<body>

<?php

$id_pf = $_GET["id_pf"];
$nom_pf = $_GET["nom_pf"];
$constructeur_pf = $_GET["constructeur_pf"];
$prix_pf = $_GET["prix_pf"];

// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = "INSERT INTO `projet`.`plateformes` (`nom_pf`, `constructeur_pf`, `prix_pf`) VALUES ('$nom_pf', '$constructeur_pf', '$prix_pf')";
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

?>

<?php

echo "</form>\n";

// Fermeture de la connexion
mysql_close($link);

?>

<?php
	if($nom_pf=="$nom_pf"){
	echo("OK, l'entr&eacute;e a &eacute;t&eacute; cr&eacute;e");
	}
	else{
	echo("KO, l'entr&eacute;e n'a pas &eacute;t&eacute; cr&eacute;e");
	}
?>

<a href="projet_all.php">retour vers la liste des jeux</a>

</body>
</html>

