<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modification OK</title>
</head>

<body>

<?php

$id_jeu = $_GET['id_jeu'];
$nom_jeu = $_GET["nom_jeu"];
$annee_jeu = $_GET["annee_jeu"];
$prix_jeu = $_GET["prix_jeu"];
$image_jeu = $_GET["image_jeu"];
$nom_editeur = $_GET["nom_editeur"];
$pays_editeur = $_GET["pays_editeur"];
$annee_editeur = $_GET["annee_editeur"];
$nom_pf = $_GET["nom_pf"];
$constructeur_pf = $_GET["constructeur_pf"];
$prix_pf = $_GET["prix_pf"];

// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = "UPDATE `projet`.`jeux`,`projet`.`editeurs`,`projet`.`plateformes` SET `nom_jeu` =  `$nom_jeu`, `annee_jeu` =  `$annee_jeu`, `prix_jeu` =  `$prix_jeu`,`image_jeu` =  `$image_jeu`, `nom_editeur` =  `$nom_editeur`, `pays_editeur` =  `$pays_editeur`, `annee_editeur` =  `$annee_editeur`, `nom_pf` =  `$nom_pf`, `constructeur_pf` =  `$constructeur_pf`, `prix_pf` =  `$prix_pf` WHERE jeux.id_editeur=editeurs.id_editeur AND jeux.id_jeu=jeux_pf.id_jeu AND plateformes.id_pf=jeux_pf.id_pf";
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

?>

<?php

// Fermeture de la connexion
mysql_close($link);

?>

<?php
	if($nom_jeu=="$nom_jeu"){
	echo("OK, l'entr&eacute;e a &eacute;t&eacute; mise &agrave; jour");
	}
	else{
	echo("KO, l'entr&eacute;e n'a pas &eacute;t&eacute; mise &agrave; jour");
	}
?>

<a href="projet_all.php">retour vers la liste des jeux</a>

</body>
</html>
