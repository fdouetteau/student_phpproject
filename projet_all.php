<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Game On!!!</title>
<link rel="icon" 
      type="image/png" 
      href="images/favicon.png" />
</head>
<body>
<div id="page">
	<div id="header">
    <a href="projet_hp.php"><span>G</span></a>
  	</div>
	<div id="content">
		<div class="side_column">
			<h1>Menu</h1>
			<ul>
            	<li><form method=get action='projet_all.php'>
				<input type="submit" value="Liste des jeux" class="button"/>
				</form></li>
				<li><form method=get action='jeu.php'>
				<input type="submit" value="Créer un jeu" class="button"/>
				</form></li>
				<li><form method=get action='editeur.php'>
				<input type="submit" value="Créer un éditeur" class="button"/>
				</form></li>
				<li><form method=get action='plateforme.php'>
				<input type="submit" value="Créer une console" class="button"/>
				</form></li>
				<li><form method=get action='package.php'>
				<input type='submit' value='Lier un jeu à une console' class="button"/>
				</form></li>
			</ul>
		</div>
		<div id="middle" >	
<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('mariececilehuet-projet') or die('Impossible de sélectionner la base de données');

// Exécution des requêtes SQL
$query = 'SELECT * FROM package NATURAL JOIN jeu NATURAL JOIN editeur NATURAL  JOIN plateforme';
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

// Affichage des résultats en HTML
echo "<table border=solid>\n";
echo "<caption>Liste des jeux</caption>\n";
echo "<tr>";
	echo "<th>Nom du jeu</th>";
	echo "<th>Année de création</th>";
	echo "<th>Prix (en euros)</th>";
	echo "<th>Pochette</th>";
	echo "<th>Editeur</th>";
	echo "<th>Pays de l'éditeur</th>";
	echo "<th>Année de création de l'éditeur</th>";
	echo "<th>Nom de la console</th>";
	echo "<th>Constructeur</th>";
	echo "<th>Prix de la console</th>";
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
<br />
<a href="projet_hp.php"><img src="images/buttonRetour.png" /></a>
</div>
        <div class="side_column">
        <img src="images/right.jpg" />
		</div>
		
	</div>
	
	<div id="footer">
		<p>Game On is brought to you by Hassen Agoun, Matthieu Delporte, Marie-Cécile Huet and Samuel Marc (il est pas beau notre site M. Spanti?)</p>
	</div>
</div>
</body>
</html>
