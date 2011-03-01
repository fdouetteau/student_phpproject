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
// = si je dis "action" et que "action" = ce que j'ai dit qui s'appelait "create", alors:
// (c'est léquivalent de noltre ancienne page create OK)
	$query = sprintf("INSERT INTO editeur (`editeur_nom`, `editeur_annee`, `editeur_pays`) VALUES ('%s', '%s', '%s')", 
	// dans ce cas, j'insère dans la base (= création), le nom d'un éditeur, son année de création et son pays / "sprintf" est une fonction qui prend un patron de chaine dans lequel les %s vont être remplacés par ce qui vient après (a.K.a; les paramètres suivants)
					mysql_real_escape_string($_POST['editeur_nom']), 
					// "mysql_real_escape_string" = en fait, ça remplace les apostrophes par back skash-apostrophe pour être sûr que la chaine de caractères et bien sécurisée
					mysql_real_escape_string($_POST['editeur_annee']), 
					mysql_real_escape_string($_POST['editeur_pays'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un editeur'); 
		
	$msg =  '<i>Nouveau editeur créé</i>'; 	
	// le message qui sera généré lorsque la requête sera effectuée
	$editeur_id = mysql_insert_id(); 
	// récupération de l'ID de l'éditeur qui a été créé grâce à "mysql_insert_id" / c'est pour insérer la donnée insérée dans la page de l'insert / c'est pour récupérer la valeur de l'auto-incrémentation
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
// (c'est léquivalent de noltre ancienne page update OK)
	$query = sprintf("UPDATE editeur SET editeur_nom='%s', editeur_annee='%s', editeur_pays = '%s' WHERE editeur_id='%s'", 
			mysql_real_escape_string($_POST['editeur_nom']), 
			mysql_real_escape_string($_POST['editeur_annee']), 
			mysql_real_escape_string($_POST['editeur_pays']), 
			mysql_real_escape_string($_POST['editeur_id'])); 
			
	$result = mysql_query($query) or die ("Impossible de modifier l'éditeur"); 
	
	$msg =  '<i>Editeur modifié</i>'; 
	$editeur_id = $_POST['editeur_id']; 
	
} else if (isset($_GET['editeur_id'])) {
// là c'est pour le read = quand je clique, dans le tableau, sur le nom d'un jeu, d'un éditeur ou d'une plateforme
// (c'est léquivalent de noltre ancienne page avec le formulaire prérempli pour update)
	$editeur_id = $_GET['editeur_id']; 
	$msg = ''; 
} else {
// // (c'est léquivalent de noltre ancienne page avec le formulaire vide pour création)
	$editeur_id = null; 
	$msg = ''; 
}

if ($editeur_id) {
// et dans tous les cas, sauf en cas de formulaire vide, je veux afficher la valeur de l'éditeru courant: soit celui que je veux modifier, soit celui que je viens de modifier, soit celui que je viens de créer, d'où la requête suivante:
	$query = 'SELECT * FROM editeur  WHERE editeur_id=' . $editeur_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le editeur selectionné ' . $editeur_id ); 
	// là, après avoir fait la requête "query", je récupère la premoère ligne avec une requête que je vais appeler "L" comme je l'appêllerai "dudule" 	
    echo "<title>{$l['editeur_nom']}</title>";
	// ici, au lieu d'avoir un titre statique comme on le fait d'habitude, on va générer un titre dynamique à chaque fois qu'on appelle un ID d'éditeur différent
	// et en fait, là on a tout mis dans le head pour que les requêtes s'exécutent avant de générer le titre pour pouvoir générer le titre
} else {
   echo "<title>Nouvel éditeur</title>";
   // ici, je dis que si je suis en mode "create", ma page va automatiquement s'appeler "nouvel éditeur"
   $l = null;  
}

   echo $msg; 
   // normalement, ça devrait être dans le body
?>
</head>
<body>

<form method='POST' action='editeur.php'>
	<p>Nom du editeur: <input name="editeur_nom" type="text" value="<?php if($l) echo $l['editeur_nom']; ?>" /></p> 
<!-- la je dis que si il y a un éditeur, j'affiche un formulaire rempli --> 
    <p>Année de création: <input name="editeur_annee" type="text" value="<?php if($l) echo $l['editeur_annee']; ?>" /></p> 
    <p>Pays: <input name="editeur_pays" type="text" value="<?php if($l) echo $l['editeur_pays']; ?>" /></p> 
<?php	if ($l == null) {
// et là, s'il n'y a pas d'éditeur, j'affiche un fomulaire vide avec les boutons pour créer
		echo '<input type="hidden" name="action" value="create" />';
		// là, je passe en "hidden" la valeur "create" si mon titre est "null"
		echo '<p><input type="submit" value="Créer"/></p>';
	} else {
		echo '<input type="hidden" name="action" value="update" />';
		// là je passe en "hidden" la valeur "update" si mon titre n'est pas "null"
		echo "<input type='hidden' name='editeur_id' value='$editeur_id' />";
		echo '<p><input type="submit" value="Modifier"/></p>';
	}
?>
</form>
    
<a href="projet_all.php">Retour vers la liste des jeux</a>

</body>
</html>