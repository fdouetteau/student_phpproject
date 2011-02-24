<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modification</title>
<link rel="stylesheet" type="text/css" href="css/form_artistes.css">
</head>

<body>

<?php

$id_jeu = $_GET['id_jeu'];

// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = 'SELECT * FROM jeux,editeurs,plateformes,jeux_pf WHERE jeux.id_editeur=editeurs.id_editeur AND jeux.id_jeu=jeux_pf.id_jeu AND plateformes.id_pf=jeux_pf.id_pf';
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

// Affichage des résultats en HTML
echo "<form method=get action=projet_modif-ok.php>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$id_jeu = $line["id_jeu"];
	$nom_jeu = $line["nom_jeu"];
	$annee_jeu = $line["annee_jeu"];
	$prix_jeu = $line["prix_jeu"];
	$image_jeu = $line["image_jeu"];
	$id_editeur = $line["id_editeur"];
	$nom_editeur = $line["nom_editeur"];
	$pays_editeur = $line["pays_editeur"];
	$annee_editeur = $line["annee_editeur"];
	$id_pf = $line["id_pf"];
	$nom_pf = $line["nom_pf"];
	$constructeur_pf = $line["constructeur_pf"];
	$prix_pf = $line["prix_pf"];
?>
	Nom du jeu: <input name="nom_jeu" type="text" value="<?php echo $nom_jeu?>" /> <br/>
    Année de création: <input name="annee_jeu" type="text" value="<?php echo $annee_jeu?>" /> <br/>
	Prix (en euros): <input name="prix_jeu" type="text" value="<?php echo $prix_jeu?>" /> <br/>
    Editeur: <input name="nom_editeur" type="text" value="<?php echo $nom_editeur?>" /> <br/>
	Pays de l'éditeur: <input name="pays_editeur" type="text" value="<?php echo $pays_editeur?>" /> <br/>
	Année de création de l'éditeur: <input name="annee_editeur" type="text" value="<?php echo $annee_editeur?>" /> <br/>
	Nom de la console: <input name="nom_pf" type="text" value="<?php echo $nom_pf?>" /> <br/>
	Constructeur: <input name="constructeur_pf" type="text" value="<?php echo $constructeur_pf?>" /> <br/>
	Prix de la console: <input name="prix_pf" type="text" value="<?php echo $prix_pf?>" /> <br/>
    <input type="submit" /> <br/>
    <input type="hidden" name="id_jeu" value="<?php echo $id_jeu?>" />

<?php
}

echo "</form>\n";

// Libération des résultats
mysql_free_result($result);

// Fermeture de la connexion
mysql_close($link);

?>
<a href="projet_supp-ok.php?id=<?php echo $id_jeu?>">Supprimer</a> <br />

<a href="projet_all.php">retour vers la liste des jeux</a>

</body>
</html>