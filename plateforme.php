<?php
include ('functions.php'); 
connect(); 

$content = ""; 

if (isset($_GET['plateforme_id'])) { // READ 
	$plateforme_id = $_GET['plateforme_id']; 
} else if (isset($_POST['action']) && $_POST['action'] == 'update') { // UPDATE
		$query = sprintf("UPDATE plateforme SET plateforme_nom='%s', plateforme_constructeur='%s', plateforme_prix = '%s' WHERE plateforme_id='%s'", 
				mysql_real_escape_string($_POST['plateforme_nom']), 
				mysql_real_escape_string($_POST['plateforme_constructeur']), 
				mysql_real_escape_string($_POST['plateforme_prix']), 
				mysql_real_escape_string($_POST['plateforme_id'])); 

		$result = mysql_query($query) or die ("Impossible de modifier la plateforme"); 

	addMessage("Plateforme Modifiée"); 
	$plateforme_id = $_POST['plateforme_id']; 
} else if (!isset($_POST['action'])) { // NEW 
 	$plateforme_id = null; 
	$msg = '';
} else if (isset($_POST['action']) && $_POST['action'] == 'create') { // CREATE
	$query = sprintf("INSERT INTO plateforme (`plateforme_nom`, `plateforme_constructeur`, `plateforme_prix`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['plateforme_nom']), 
					mysql_real_escape_string($_POST['plateforme_constructeur']), 
					mysql_real_escape_string($_POST['plateforme_prix'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un plateforme'); 
	
	addMessage("Nouvelle Plateforme Crée"); 	
	$plateforme_id = mysql_insert_id(); 
	
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') { // DELETE
		$query = sprintf("DELETE FROM package, plateforme USING package NATURAL JOIN plateforme WHERE plateforme.plateforme_id='%s'", 
				mysql_real_escape_string($_POST['plateforme_id'])); 
		$result = mysql_query("$query") or die ("Impossible d'effacer la plateforme" . mysql_error()); 


    addMessage("La console et les distributions de jeu associées ont été effacées. Vous pouvez créer une nouvelle console");  
	$plateforme_id = null; 

}

if ($plateforme_id) {
	$query = 'SELECT * FROM plateforme WHERE plateforme_id=' . $plateforme_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver la console selectionné ' . $plateforme_id );  	
    $title =  $l['plateforme_nom'];
} else {
    $title = "Nouvelle console";
    $l = null;  
}

/* Formulaire d'affichage / modification ou création */ 

$content .= "<form method='POST' action='plateforme.php' >
	<p>Nom de la console: <input name='plateforme_nom' type='text' value='$l[plateforme_nom]' /></p> 
    <p>Constructeur: <input name='plateforme_constructeur' type='text' value='$l[plateforme_constructeur]' /></p> 
     <p>Prix: <input name='plateforme_prix' type='text' value='$l[plateforme_prix]' /></p>"; 

if ($l == null) {
	$content .= '<input type="hidden" name="action" value="create" />';
	$content .= '<p><input type="submit" value="Créer" class="button"/></p>';
} else {
	$content .= '<input type="hidden" name="action" value="update" />';
	$content .= "<input type='hidden' name='plateforme_id' value='$plateforme_id' />";
	$content .= '<p><input type="submit" value="Modifier" class="button"/></p>';
}
	
$content .= '</form>'; 

if ($plateforme_id) {
	$content .= suppressForm("plateforme.php", "plateforme_id", $plateforme_id, "Supprimer cette console (et toutes les distribution de jeux associées)"); 
}

include ('layout.php'); 
?>