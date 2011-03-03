<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Suivant les paramètres: affichage d'un plateforme existant, création d'un nouveau plateforme, confirmation de création ...

if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$query = sprintf("INSERT INTO plateforme (`plateforme_nom`, `plateforme_constructeur`, `plateforme_prix`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['plateforme_nom']), 
					mysql_real_escape_string($_POST['plateforme_constructeur']), 
					mysql_real_escape_string($_POST['plateforme_prix'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un plateforme'); 
		
	$msg =  '<i>Nouveau plateforme crée</i>'; 	
	$plateforme_id = mysql_insert_id(); 
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
	$query = sprintf("UPDATE plateforme SET plateforme_nom='%s', plateforme_constructeur='%s', plateforme_prix = '%s' WHERE plateforme_id='%s'", 
			mysql_real_escape_string($_POST['plateforme_nom']), 
			mysql_real_escape_string($_POST['plateforme_constructeur']), 
			mysql_real_escape_string($_POST['plateforme_prix']), 
			mysql_real_escape_string($_POST['plateforme_id'])); 
			
	$result = mysql_query($query) or die ("Impossible de modifier la plateforme"); 
	
	$msg =  '<i>plateforme modifié</i>'; 
	$plateforme_id = $_POST['plateforme_id']; 
	
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		$query = sprintf("DELETE FROM package, plateforme USING package NATURAL JOIN plateforme WHERE plateforme.plateforme_id='%s'", 
				mysql_real_escape_string($_POST['plateforme_id'])); 
		$result = mysql_query("$query") or die ("Impossible d'effacer la plateforme" . mysql_error()); 


		$msg = '<i>La plateforme et les distributions de jeu associées ont été effacées. Vous pouvez créer une nouvelle plateforme.</i>'; 
		$plateforme_id = null; 

} else if (isset($_GET['plateforme_id'])) {
	$plateforme_id = $_GET['plateforme_id']; 
	$msg = ''; 
} else {
	$plateforme_id = null; 
	$msg = ''; 
}

if ($plateforme_id) {
	$query = 'SELECT * FROM plateforme WHERE plateforme_id=' . $plateforme_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le plateforme selectionné ' . $plateforme_id );  	
    echo "<title>{$l['plateforme_nom']}</title>";
} else {
   echo "<title>Nouvelle plateforme</title>";
   $l = null;  
}

   echo $msg; 
?>
</head>
<body>

<form method='POST' action='plateforme.php'>
	<p>Nom du plateforme: <input name="plateforme_nom" type="text" value="<?php if($l) echo $l['plateforme_nom']; ?>" /></p> 
    <p>Constructeur: <input name="plateforme_constructeur" type="text" value="<?php if($l) echo $l['plateforme_constructeur']; ?>" /></p> 
     <p>Prix: <input name="plateforme_prix" type="text" value="<?php if($l) echo $l['plateforme_prix']; ?>" /></p> 
<?php	if ($l == null) {
		echo '<input type="hidden" name="action" value="create" />';
		echo '<p><input type="submit" value="Créer"/></p>';
	} else {
		echo '<input type="hidden" name="action" value="update" />';
		echo "<input type='hidden' name='plateforme_id' value='$plateforme_id' />";
		echo '<p><input type="submit" value="Modifier"/></p>';
	}
?>
</form>
  
<form method='POST' action='plateforme.php' onsubmit="return confirm('Etes-vous sûr de vouloir effacer?')")>
	<input type="hidden" name="action" value="delete"/>
	<input type="hidden" name="plateforme_id" value="<?php echo $plateforme_id?>"/>
	<input type="submit" value="Supprimer cette plateforme (et toutes les distributions de jeux associées)" />
</form>
  
<a href="projet_all.php">Retour vers la liste des jeux</a>

</body>
</html>