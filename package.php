<?php
include('functions.php'); 
connect(); 

// Suivant les paramètres: affichage d'un jeu existant, création d'un nouveau jeu, confirmation de création ...

$content = ""; 

if (isset($_GET['package_id'])) {
	$package_id = $_GET['package_id']; 
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
		$query = sprintf("UPDATE package SET jeu_id='%s', plateforme_id='%s', prix = '%s' WHERE package_id='%s'", 
				mysql_real_escape_string($_POST['jeu_id']), 
				mysql_real_escape_string($_POST['plateforme_id']), 
				mysql_real_escape_string($_POST['prix']), 
				mysql_real_escape_string($_POST['package_id'])); 

		$result = mysql_query($query) or die ("Impossible de modifier la référence produit"); 

		addMessage("Référence produit modifiée");
		$package_id = $_POST['package_id']; 
} else if (!isset($_POST['action'])) {
	$package_id = null; 

} else if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$query = sprintf("INSERT INTO package (`jeu_id`, `plateforme_id`, `package_prix`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['jeu_id']), 
					mysql_real_escape_string($_POST['plateforme_id']), 
					mysql_real_escape_string($_POST['package_prix'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer une référence produit'); 

	addMessage("Nouvelle distribution crée"); 
	$package_id = mysql_insert_id(); 

} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		$query = sprintf("DELETE FROM package WHERE package_id='%s'", 
				mysql_real_escape_string($_POST['package_id'])); 
		$result = mysql_query("$query") or die ("Impossible d'effacer la distribution" . mysql_error()); 

   addMessage("Référence produit effacée. Vous pouvez créer une nouvelle référence produit"); 
		$package_id = null; 
} 

// Récupérer les informations sur la distribution. 

if ($package_id) {
	$query = 'SELECT * FROM package NATURAL JOIN plateforme NATURAL JOIN jeu  WHERE package_id=' . $package_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver la référence selectionnée ' . $package_id );  	
    $title = "$l[jeu_nom] sur $l[plateforme_nom]";
} else {
    $title = "Nouvelle référence produit"; 
   $l = null;  
}

$content .= "<form method='POST' action='package.php'>
    		<p>Prix du jeu en fonction de la console : <input name='package_prix' type='text' value='$l[package_prix]'/></p>";

	$content .= "<p>Jeu : <select name='jeu_id'>"; 
	$query = 'SELECT * from jeu'; 
	$result = mysql_query($query); 
	while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$selected = $e['jeu_id'] == $l['jeu_id']; 
		$content .= "<option value='{$e['jeu_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['jeu_nom']}</option>"; 
	}
	$content .= "</select></p>";    
	
 	$content .= "<p>Plateforme : <select name='plateforme_id'>"; 
	$query = 'SELECT * from plateforme'; 
	$result = mysql_query($query); 
	while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$selected = $e['plateforme_id'] == $l['plateforme_id']; 
		$content .= "<option value='{$e['plateforme_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['plateforme_nom']}</option>"; 
	}

	if ($l == null) {
		$content .= '<input type="hidden" name="action" value="create" />';
		$content .= '<p><input type="submit" value="Créer"class="button"/></p>';
	} else {
		$content .= '<input type="hidden" name="action" value="update" />';
		$content .= "<input type='hidden' name='package_id' value='$package_id' />";
		$contnet .= '<p><input type="submit" value="Modifier"class="button"/></p>';
	}

	if ($package_id) {
		$content .= suppressForm('package.php', 'package_id', $package_id, "Supprimer cette référence produit ?"); 
	}
include ('layout.php'); 

?>