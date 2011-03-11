<?php
include ('functions.php'); 
connect(); 

// Suivant les paramètres: affichage d'un jeu existant, création d'un nouveau jeu, confirmation de création ...

$content = ""; 
if (isset($_GET['jeu_id'])) { // READ
	$jeu_id = $_GET['jeu_id']; 

} else if (isset($_POST['action']) && $_POST['action'] == 'update') { // UPDATE
		$query = sprintf("UPDATE jeu SET jeu_nom='%s', jeu_annee='%s', editeur_id = '%s' WHERE jeu_id='%s'", 
				mysql_real_escape_string($_POST['jeu_nom']), 
				mysql_real_escape_string($_POST['jeu_annee']), 
				mysql_real_escape_string($_POST['editeur_id']), 
				mysql_real_escape_string($_POST['jeu_id'])); 

		$result = mysql_query($query) or die ("Impossible de modifier le jeu"); 
		addMessage("Jeu Modifié"); 
		$jeu_id = $_POST['jeu_id']; 
} else if (!isset($_POST['action'])) { // NEW 
	$jeu_id = null; 

} else if (isset($_POST['action']) && $_POST['action'] == 'create') { // CREATE 
	$query = sprintf("INSERT INTO jeu (`jeu_nom`, `jeu_annee`, `editeur_id`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['jeu_nom']), 
					mysql_real_escape_string($_POST['jeu_annee']), 
					mysql_real_escape_string($_POST['editeur_id'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un jeu'); 
	addMessage("Nouveau jeu crée"); 
	$jeu_id = mysql_insert_id(); 
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {  // DELETE
	$query = sprintf("DELETE FROM package, jeu USING package NATURAL JOIN jeu WHERE jeu.jeu_id='%s'", 
			mysql_real_escape_string($_POST['jeu_id'])); 
	$result = mysql_query("$query") or die ("Impossible d'effacer le jeu" . mysql_error()); 

	addMessage("Jeu effacé. Vous pouvez créer un nouveau jeu"); 
	$jeu_id = null; 
} 

if ($jeu_id) {
	$query = 'SELECT * FROM jeu NATURAL JOIN editeur  WHERE jeu_id=' . $jeu_id;
	// "natural join" est un join que s'effectue sur les colonnes qui ont le même nom entre les deux tables / ici, c'est "editeur_id" / à ne pas confondre avec "inner join" qui dit qu'on n'affiche dans le résultat que les lignes pour lesquelles on a quelque chose venant des deux tables / "outer join": affiche les lignes, même s'il n'y pas de résultat dans une des deux tables / ici on pourrait donc écrire "natural inner join" et ce serait la même chose
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le jeu selectionné ' . $jeu_id );  	
    $title = $l['jeu_nom']; 
} else {
	$title = "Nouveau jeu"; 
	   $l = null;  
}

$content .= "<form method='POST' action='jeu.php'>
	<p>Nom du jeu: <input name='jeu_nom' type='text' value='$l[jeu_nom]' /></p> 
    <p>Année de création: <input name='jeu_annee' type='text' value='$l[jeu_annee]' /></p> 
    <p>Editeur : <select name='editeur_id'>"; 
		$query = 'SELECT * from editeur'; 
		$result = mysql_query($query); 
		while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$selected = $e['editeur_id'] == $l['editeur_id']; 
			$content .= "<option value='{$e['editeur_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['editeur_nom']}</option>"; 
		}
$content .= "</select></p>"; 

if ($l == null) {
 	$content .= '<input type="hidden" name="action" value="create" />';
	$content .= '<p><input type="submit" value="Créer" class="button"/></p>';
	} else {
	$content .= '<input type="hidden" name="action" value="update" />';
	$content .= "<input type='hidden' name='jeu_id' value='$jeu_id' />";
	$content .= '<p><input type="submit" value="Modifier" class="button"/></p>';
	}

$content .= "</form>"; 

$content .= "<img src='projet_image.php?jeu_id=$jeu_id' alt='$l[jeu_nom]' />"; 
   // afficher l'image courante s'il y en a une

$content .= "<!-- formulaire pour uploader une image: --><p>Pochette"; 

/*  "enctype" = encoding type, c'est-à-dire: la manière dont les paramètres vont être passés dans la requête */ 
$content .= "<form method='POST' action='upload_image.php' enctype='multipart/form-data' >
	  			<input type='hidden' name='jeu_id' value='$jeu_id' />
   				<input type='file' name='image'/>
				<input type='submit' value='Changer la pochette' class='button'>
			</form>"; 
$content .= "</p>"; 

if ($jeu_id) {
	$content .= suppressForm("jeu.php", "jeu_id", $jeu_id, "Supprimer ce jeu et toutes les références produits associées"); 
}

include ('layout.php'); 
?>