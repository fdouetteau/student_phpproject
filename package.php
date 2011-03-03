<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Suivant les paramètres: affichage d'un jeu existant, création d'un nouveau jeu, confirmation de création ...


if (isset($_GET['package_id'])) {
	$package_id = $_GET['package_id']; 
	$msg = '';
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
		$query = sprintf("UPDATE package SET jeu_id='%s', plateforme_id='%s', prix = '%s' WHERE package_id='%s'", 
				mysql_real_escape_string($_POST['jeu_id']), 
				mysql_real_escape_string($_POST['plateforme_id']), 
				mysql_real_escape_string($_POST['prix']), 
				mysql_real_escape_string($_POST['package_id'])); 

		$result = mysql_query($query) or die ("Impossible de modifier le jeu"); 

		$msg =  '<i>Distribution  modifié</i>'; 
		$package_id = $_POST['package_id']; 
} else if (!isset($_POST['action'])) {
	$package_id = null; 
	$msg = ''; 
} else if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$query = sprintf("INSERT INTO package (`jeu_id`, `plateforme_id`, `package_prix`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['jeu_id']), 
					mysql_real_escape_string($_POST['plateforme_id']), 
					mysql_real_escape_string($_POST['package_prix'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un package'); 
		
	$msg =  '<i>Nouvelle distribution crée</i>'; 	
	$package_id = mysql_insert_id(); 

} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		$query = sprintf("DELETE FROM package WHERE package_id='%s'", 
				mysql_real_escape_string($_POST['package_id'])); 
		$result = mysql_query("$query") or die ("Impossible d'effacer la distribution" . mysql_error()); 

		$msg = '<i>Distribution de jeu effacé. Vous pouvez créer une nouvelle distribution.</i>'; 
		$package_id = null; 
} 


if ($package_id) {
	$query = 'SELECT * FROM package NATURAL JOIN plateforme NATURAL JOIN jeu  WHERE package_id=' . $package_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le package selectionné ' . $package_id );  	
    echo "<title>{$l['jeu_nom']} sur {$l['plateforme_nom']}</title>";
} else {
   echo "<title>Nouveau package</title>";
   $l = null;  
}

   echo $msg; 
?>
</head>
<body>

<form method='POST' action='package.php'>
    <p>Prix: <input name="package_prix" type="text" value="<?php if($l) echo $l['package_prix']; ?>" /></p> 
   <p>Jeux : <select name='jeu_id'>
	<?php
	$query = 'SELECT * from jeu'; 
	$result = mysql_query($query); 
	while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$selected = $e['jeu_id'] == $l['jeu_id']; 
		echo "<option value='{$e['jeu_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['jeu_nom']}</option>"; 
	}
	?>
</select></p>   
 <p>Plateforme : <select name='plateforme_id'>
	<?php
	$query = 'SELECT * from plateforme'; 
	$result = mysql_query($query); 
	while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$selected = $e['plateforme_id'] == $l['plateforme_id']; 
		echo "<option value='{$e['plateforme_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['plateforme_nom']}</option>"; 
	}
	?>
</select></p>
<?php	if ($l == null) {
		echo '<input type="hidden" name="action" value="create" />';
		echo '<p><input type="submit" value="Créer"/></p>';
	} else {
		echo '<input type="hidden" name="action" value="update" />';
		echo "<input type='hidden' name='package_id' value='$package_id' />";
		echo '<p><input type="submit" value="Modifier"/></p>';
	}
?>
</form>

<form method='POST' action='package.php' onsubmit="return confirm('Etes-vous sûr de vouloir effacer?')")>
	<input type="hidden" name="action" value="delete"/>
	<input type="hidden" name="package_id" value="<?php echo $package_id?>"/>
	<input type="submit" value="Supprimer ce package" />
</form>
    
<a href="projet_all.php">Retour vers la liste des jeux</a>

</body>
</html>