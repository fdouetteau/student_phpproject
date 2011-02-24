<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Liste jeux</title>
</head>

<body>

<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = 'SELECT * FROM jeux,editeurs,plateformes,jeux_pf WHERE jeux.id_editeur=editeurs.id_editeur AND jeux.id_jeu=jeux_pf.id_jeu AND plateformes.id_pf=jeux_pf.id_pf';
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

// Affichage des résultats en HTML
echo "<table border=solid>\n";
echo "<tr>";
	echo "<td>Nom du jeu</td>";
	echo "<td>Année de création</td>";
	echo "<td>Prix (en euros)</td>";
	echo "<td>Pochette</td>";
	echo "<td>Editeur</td>";
	echo "<td>Pays de l'éditeur</td>";
	echo "<td>Année de création de l'éditeur</td>";
	echo "<td>Nom de la console</td>";
	echo "<td>Constructeur</td>";
	echo "<td>Prix de la console</td>";
echo "</tr>";
	
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
	
	
    echo "<tr>";
		echo "<td><a href=\"projet_modif-all.php?id=$id_jeu\">$nom_jeu</a></td>";
		echo "<td>$annee_jeu</td>";
		echo "<td>$prix_jeu</td>";
		echo "<td><img src='projet_image.php?id_jeu=$id_jeu'/></td>";
		echo "<td><a href=\"projet_modif-all.php?id=$id_editeur\">$nom_editeur</a></td>";
		echo "<td>$pays_editeur</td>";
		echo "<td>$annee_editeur</td>";
		echo "<td><a href=\"projet_modif-all.php?id=$id_pf\">$nom_pf</a></td>";
		echo "<td>$constructeur_pf</td>";
		echo "<td>$prix_pf</td>";					
	echo "</tr>";		
}
  
echo "</table>\n";

// Libération des résultats
mysql_free_result($result);

// Fermeture de la connexion
mysql_close($link);
?>

<form method=get action=projet_crea-jeu.php>
	<input type="submit" value="Créer un jeu" />
</form>
<form method=get action=projet_crea-editeur.php>
	<input type="submit" value="Créer un éditeur" />
</form>
<form method=get action=projet_crea-pf.php>
	<input type="submit" value="Créer une console" />
</form>

<a href="projet_hp.php">retour vers la page d'accueil</a>

</body>
</html>