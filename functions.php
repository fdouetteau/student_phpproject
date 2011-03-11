<?php

global $content; 

/* Ouvre la connexion et sélectionne la base */ 
function connect() {
	mysql_connect('localhost', 'root', '')
	    or die('Impossible de se connecter : ' . mysql_error());
	mysql_select_db('projet') or die('Impossible de sélectionner la base de données');
}

/* Ferme la connection vers la base de donnée */  
function closeConnection() {
	mysql_close(); 
}

/* Ajoute un message text pour notifier du succès de la dernière action */ 
function addMessage($msg) {
	global $content; 
	$content .= "<div class='msg'>$msg</div>"; 
} 

/* Genère un formulaire de suppression */
function suppressForm($targetPage, $idName, $idValue, $msg) {
return "<form method='POST' action='plateforme.php' onsubmit='return deleteConfirm();'>
	<input type='hidden' name='action' value='delete'/>
	<input type='hidden' name='$idName' value='$idValue'/>
	<input type='submit' value='$msg'  class='button'/>
</form>"; 
}

?>