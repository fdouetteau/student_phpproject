<?php

include('functions.php'); 
connect();

// Exécution des requêtes SQL
$query = 'SELECT * FROM package NATURAL JOIN jeu NATURAL JOIN editeur NATURAL  JOIN plateforme';
$result = mysql_query($query) or die('Échec de la requête : ' . mysql_error());

$content = ""; 

$content .= '<table border="solid">
	<caption>Liste des références produits</caption>
		<tr>
			<th>Nom du jeu</th>
			<th>Année de création</th>
			<th>Prix (en euros)</th>
			<th>Pochette</th>
			<th>Editeur</th>
			<th>Pays de l\'éditeur</th>
			<th>Année de création de l\'éditeur</th>
			<th>Nom de la console</th>
			<th>Constructeur</th>
			<th>Prix de la console</th>
		</tr>'; 
		
	
while ($l = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $content .= "<tr>";
		$content .= "<td><a href=\"jeu.php?jeu_id=$l[jeu_id]\">$l[jeu_nom]</a></td>";
		$content .= "<td>$l[jeu_annee]</td>";
		$content .= "<td>$l[package_prix]</td>";
		$content .= "<td><img src='projet_image.php?jeu_id=$l[jeu_id]'/></td>";
		$content .= "<td><a href='editeur.php?editeur_id=$l[editeur_id]'>$l[editeur_nom]</a></td>";
		$content .= "<td>$l[editeur_pays]</td>";
		$content .= "<td>$l[editeur_annee]</td>";
		$content .= "<td><a href=\"plateforme.php?plateforme_id=$l[plateforme_id]\">$l[plateforme_nom]</a></td>";
		$content .= "<td>$l[plateforme_constructeur]</td>";
		$content .= "<td>$l[plateforme_prix]</td>";					
	$content .= "</tr>";		
}

$content .= '</table>'; 


$title = "Game On!!!"; 
// Libération des résultats
mysql_free_result($result);

// Fermeture de la connexion
mysql_close($link);

include('layout.php'); 
?>
