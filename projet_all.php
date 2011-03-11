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
			<th></th>			
			<th>Jeu</th>
			<th>Année de conception</th>
			<th>Prix Indicatif</th>
			<th>Editeur</th>
			<th>Console</th>
		</tr>'; 
		
	
while ($l = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $content .= "<tr>";
		$content .= "<td ><a href='package.php?package_id=$l[package_id]'><img width='50px' src='projet_image.php?jeu_id=$l[jeu_id]' alt='$l[jeu_nom]'/></a></td>";
		$content .= "<td><a href=\"jeu.php?jeu_id=$l[jeu_id]\">$l[jeu_nom]</a></td>";
		$content .= "<td>$l[jeu_annee]</td>";
		$content .= "<td>$l[package_prix] €</td>";
		$content .= "<td><a href='editeur.php?editeur_id=$l[editeur_id]'>$l[editeur_nom]</a> ($l[editeur_pays], depuis $l[editeur_annee])</td>";
		$content .= "<td><a href=\"plateforme.php?plateforme_id=$l[plateforme_id]\">$l[plateforme_nom]</a> ($l[plateforme_constructeur], environ $l[plateforme_prix]€)</td>";
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
