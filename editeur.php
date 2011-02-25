<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

// Suivant les paramètres: affichage d'un editeur existant, création d'un nouveau editeur, confirmation de création ...

if (isset($_POST['action']) && $_POST['action'] == 'create') {
	$query = sprintf("INSERT INTO editeur (`editeur_nom`, `editeur_annee`, `editeur_pays`) VALUES ('%s', '%s', '%s')", 
					mysql_real_escape_string($_POST['editeur_nom']), 
					mysql_real_escape_string($_POST['editeur_annee']), 
					mysql_real_escape_string($_POST['editeur_pays'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un editeur'); 
		
	$msg =  '<i>Nouveau editeur crée</i>'; 	
	$editeur_id = mysql_insert_id(); 
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
	$query = sprintf("UPDATE editeur SET editeur_nom='%s', editeur_annee='%s', editeur_pays = '%s' WHERE editeur_id='%s'", 
			mysql_real_escape_string($_POST['editeur_nom']), 
			mysql_real_escape_string($_POST['editeur_annee']), 
			mysql_real_escape_string($_POST['editeur_pays']), 
			mysql_real_escape_string($_POST['editeur_id'])); 
			
	$result = mysql_query($query) or die ("Impossible de modifier l'éditeur"); 
	
	$msg =  '<i>Editeur modifié</i>'; 
	$editeur_id = $_POST['editeur_id']; 
	
} else if (isset($_GET['editeur_id'])) {
	$editeur_id = $_GET['editeur_id']; 
	$msg = ''; 
} else {
	$editeur_id = null; 
	$msg = ''; 
}

if ($editeur_id) {
	$query = 'SELECT * FROM editeur  WHERE editeur_id=' . $editeur_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le editeur selectionné ' . $editeur_id );  	
    echo "<title>{$l['editeur_nom']}</title>";
} else {
   echo "<title>Nouvel éditeur</title>";
   $l = null;  
}

   echo $msg; 
?>
</head>
<body>

<form method='POST' action='editeur.php'>
	<p>Nom du editeur: <input name="editeur_nom" type="text" value="<?php if($l) echo $l['editeur_nom']; ?>" /></p> 
    <p>Année de création: <input name="editeur_annee" type="text" value="<?php if($l) echo $l['editeur_annee']; ?>" /></p> 
    <p>Pays: <input name="editeur_pays" type="text" value="<?php if($l) echo $l['editeur_pays']; ?>" /></p> 
<?php	if ($l == null) {
		echo '<input type="hidden" name="action" value="create" />';
		echo '<p><input type="submit" value="Créer"/></p>';
	} else {
		echo '<input type="hidden" name="action" value="update" />';
		echo "<input type='hidden' name='editeur_id' value='$editeur_id' />";
		echo '<p><input type="submit" value="Modifier"/></p>';
	}
?>
</form>
    
<a href="projet_all.php">Retour vers la liste des jeux</a>

</body>
</html>