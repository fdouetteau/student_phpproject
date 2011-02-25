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

if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$query = sprintf("INSERT INTO jeu (`jeu_nom`, `jeu_annee`, `editeur_id`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['jeu_nom']), 
					mysql_real_escape_string($_POST['jeu_annee']), 
					mysql_real_escape_string($_POST['editeur_id'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un jeu'); 
		
	$msg =  '<i>Nouveau jeu crée</i>'; 	
	$jeu_id = mysql_insert_id(); 
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
	$query = sprintf("UPDATE jeu SET jeu_nom='%s', jeu_annee='%s', editeur_id = '%s' WHERE jeu_id='%s'", 
			mysql_real_escape_string($_POST['jeu_nom']), 
			mysql_real_escape_string($_POST['jeu_annee']), 
			mysql_real_escape_string($_POST['editeur_id']), 
			mysql_real_escape_string($_POST['jeu_id'])); 
			
	$result = mysql_query($query) or die ("Impossible de modifier le jeu"); 
	
	$msg =  '<i>Jeu modifié</i>'; 
	$jeu_id = $_POST['jeu_id']; 
	
} else if (isset($_GET['jeu_id'])) {
	$jeu_id = $_GET['jeu_id']; 
	$msg = ''; 
} else {
	$jeu_id = null; 
	$msg = ''; 
}

if ($jeu_id) {
	$query = 'SELECT * FROM jeu NATURAL JOIN editeur  WHERE jeu_id=' . $jeu_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le jeu selectionné ' . $jeu_id );  	
    echo "<title>{$l['jeu_nom']}</title>";
} else {
   echo "<title>Nouveau jeu</title>";
   $l = null;  
}

   echo $msg; 
?>
</head>
<body>

<form method='POST' action='jeu.php'>
	<p>Nom du jeu: <input name="jeu_nom" type="text" value="<?php if($l) echo $l['jeu_nom']; ?>" /></p> 
    <p>Année de création: <input name="jeu_annee" type="text" value="<?php if($l) echo $l['jeu_annee']; ?>" /></p> 
    <p>Editeur : <select name='editeur_id'>
	<?php
	$query = 'SELECT * from editeur'; 
	$result = mysql_query($query); 
	while ($e = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$selected = $e['editeur_id'] == $l['editeur_id']; 
		echo "<option value='{$e['editeur_id']}'" . ($selected ? "selected='selected'" : "" ) . ">{$e['editeur_nom']}</option>"; 
	}
	?>
</select></p>
<?php	if ($l == null) {
		echo '<input type="hidden" name="action" value="create" />';
		echo '<p><input type="submit" value="Créer"/></p>';
	} else {
		echo '<input type="hidden" name="action" value="update" />';
		echo "<input type='hidden' name='jeu_id' value='$jeu_id' />";
		echo '<p><input type="submit" value="Modifier"/></p>';
	}
?>
</form>
    
<a href="projet_all.php">Retour vers la liste des jeux</a>

</body>
</html>