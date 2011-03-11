<?php
include('functions.php'); 
connect(); 
// Suivant les paramètres: affichage d'un editeur existant, création d'un nouveau editeur, confirmation de création ...

$content = ""; 

if (isset($_GET['editeur_id'])) { // READ
// là c'est pour le read = quand je clique, dans le tableau, sur le nom d'un jeu, d'un éditeur ou d'une plateforme
// (c'est léquivalent de noltre ancienne page avec le formulaire prérempli pour update)
	$editeur_id = $_GET['editeur_id']; 

} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
	// (c'est léquivalent de noltre ancienne page update OK)
		$query = sprintf("UPDATE editeur SET editeur_nom='%s', editeur_annee='%s', editeur_pays = '%s' WHERE editeur_id='%s'", 
				mysql_real_escape_string($_POST['editeur_nom']), 
				mysql_real_escape_string($_POST['editeur_annee']), 
				mysql_real_escape_string($_POST['editeur_pays']), 
				mysql_real_escape_string($_POST['editeur_id'])); 

		$result = mysql_query($query) or die ("Impossible de modifier l'éditeur"); 

		addMessage("Editeur modifié"); 
		$editeur_id = $_POST['editeur_id'];
} else if (!isset($_POST['action'])) {
		// // (c'est léquivalent de noltre ancienne page avec le formulaire vide pour création)
			$editeur_id = null; 

} else if (isset($_POST['action']) && $_POST['action'] == 'create') {
// = si je dis "action" et que "action" = ce que j'ai dit qui s'appelait "create", alors:
// (c'est léquivalent de noltre ancienne page create OK)
	$query = sprintf("INSERT INTO editeur (`editeur_nom`, `editeur_annee`, `editeur_pays`) VALUES ('%s', '%s', '%s')", 
	// dans ce cas, j'insère dans la base (= création), le nom d'un éditeur, son année de création et son pays / "sprintf" est une fonction qui prend un patron de chaine dans lequel les %s vont être remplacés par ce qui vient après (a.K.a; les paramètres suivants)
					mysql_real_escape_string($_POST['editeur_nom']), 
					// "mysql_real_escape_string" = en fait, ça remplace les apostrophes par back skash-apostrophe pour être sûr que la chaine de caractères et bien sécurisée
					mysql_real_escape_string($_POST['editeur_annee']), 
					mysql_real_escape_string($_POST['editeur_pays'])); 
					
	$result = mysql_query($query) or die ('Impossible de creer un editeur'); 
		
	addMessage("Nouvel éditeur crée");  	
	// le message qui sera généré lorsque la requête sera effectuée
	$editeur_id = mysql_insert_id(); 
	// récupération de l'ID de l'éditeur qui a été créé grâce à "mysql_insert_id" / c'est pour insérer la donnée insérée dans la page de l'insert / c'est pour récupérer la valeur de l'auto-incrémentation

} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		$query = sprintf("DELETE FROM package, jeu, editeur USING package NATURAL JOIN jeu NATURAL JOIN editeur WHERE editeur.editeur_id='%s'", 
				mysql_real_escape_string($_POST['editeur_id'])); 
		$result = mysql_query("$query") or die ("Impossible d'effacer le jeu" . mysql_error()); 

	addMessage("Editeur effacé. Vous pouvez créer un nouvel éditeur.");  
	$editeur_id = null; 

} 

if ($editeur_id) {
// et dans tous les cas, sauf en cas de formulaire vide, je veux afficher la valeur de l'éditeru courant: soit celui que je veux modifier, soit celui que je viens de modifier, soit celui que je viens de créer, d'où la requête suivante:
	$query = 'SELECT * FROM editeur  WHERE editeur_id=' . $editeur_id;
	$result = mysql_query($query) or die('Échec de la requête : ' . $query . "=>". mysql_error());
	$l =  mysql_fetch_array($result, MYSQL_ASSOC) or die('Impossible de trouver le editeur selectionné ' . $editeur_id ); 
	// là, après avoir fait la requête "query", je récupère la premoère ligne avec une requête que je vais appeler "L" comme je l'appêllerai "dudule" 
	$title = $l['editeur_nom']; 
		// ici, au lieu d'avoir un titre statique comme on le fait d'habitude, on va générer un titre dynamique à chaque fois qu'on appelle un ID d'éditeur différent
	// et en fait, là on a tout mis dans le head pour que les requêtes s'exécutent avant de générer le titre pour pouvoir générer le titre
} else {
	$title = "Nouvel éditeur"; 
   // ici, je dis que si je suis en mode "create", ma page va automatiquement s'appeler "nouvel éditeur"
   $l = null;  
}

  $content .=  "<form method='POST' action='editeur.php'>
		<p>Nom de l'éditeur: <input name='editeur_nom' type='text' value='$l[editeur_nom]' 
	    <p>Année de création: <input name='editeur_annee' type='text' value='$l[editeur_annee]' /></p> 
	    <p>Pays: <input name='editeur_pays' type='text' value='$l[editeur_pays]' /></p>"; 

if ($l == null) {
// et là, s'il n'y a pas d'éditeur, j'affiche un fomulaire vide avec les boutons pour créer
		$content .= '<input type="hidden" name="action" value="create" />';
		// là, je passe en "hidden" la valeur "create" si mon titre est "null"
		$contnet .= '<p><input type="submit" value="Créer" class="button"/></p>';
	} else {
		$content .= '<input type="hidden" name="action" value="update" />';
		// là je passe en "hidden" la valeur "update" si mon titre n'est pas "null"
		$content .= "<input type='hidden' name='editeur_id' value='$editeur_id' />";
		$content .= '<p><input type="submit" value="Modifier" class="button"/></p>';
	}

$content .= "</form>"; 

	if ($editeur_id) {
		$content .= suppressForm("editeur.php", "editeur_id", $editeur_id, "Supprimer cet éditeur, et toutes les jeux associés ?"); 
	}
	 
include('layout.php'); 
?>