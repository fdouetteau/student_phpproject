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
$query = 'SELECT * FROM package NATURAL JOIN jeu NATURAL JOIN editeur NATURAL  JOIN plateforme';
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
	
while ($l = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<tr>";
		echo "<td><a href=\"jeu.php?jeu_id={$l['jeu_id']}\">{$l['jeu_nom']}</a></td>";
		echo "<td>{$l['jeu_annee']}</td>";
		echo "<td>{$l['package_prix']}</td>";
		echo "<td><img src='projet_image.php?jeu_id={$l['jeu_id']}'/></td>";
		echo "<td><a href='editeur.php?editeur_id={$l['editeur_id']}'>{$l['editeur_nom']}</a></td>";
		echo "<td>{$l['editeur_pays']}</td>";
		echo "<td>{$l['editeur_annee']}</td>";
		echo "<td><a href=\"plateforme.php?plateforme_id={$l['plateforme_id']}\">{$l['plateforme_nom']}</a></td>";
		echo "<td>{$l['plateforme_constructeur']}</td>";
		echo "<td>{$l['plateforme_prix']}</td>";					
	echo "</tr>";		
}
  
echo "</table>\n";

// Libération des résultats
mysql_free_result($result);

// Fermeture de la connexion
mysql_close($link);
?>

<form method=get action='jeu.php'>
	<input type="submit" value="Créer un jeu" />
</form>
<form method=get action='editeur.php'>
	<input type="submit" value="Créer un éditeur" />
</form>
<form method=get action='plateforme.php'>
	<input type="submit" value="Créer une console" />
</form>
<form method=get action='package.php'>
	<input type='submit' value='Créer une distribution' />
</form>

<a href="projet_hp.php">retour vers la page d'accueil</a>

</body>
</html>