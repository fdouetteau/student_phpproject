<html>
  <head>
  </head>
<body>
<?php

$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

  $jeu_id = $_POST['jeu_id'];

  $file = $_FILES['image']['tmp_name']; 

  $fp      = fopen($file, 'r');
  $content = fread($fp, filesize($file));
  $content = mysql_real_escape_string($content);
  fclose($fp);
  
  $query = 
	sprintf("INSERT INTO image (jeu_id, image_contenu) VALUES ('%s',  '%s') ON DUPLICATE KEY UPDATE image_contenu='%s'", 
			mysql_real_escape_string($jeu_id), 
			$content, $content); 
    
  mysql_query($query) or die("Impossible d'insérer l'image: " . mysql_error()); 

  echo "<p>Insertion de l'image effectue</p>"; 

  echo "<p><a href='jeu.php?jeu_id=$jeu_id'>Retour à la fiche du jeu</a></p>"; 
?>
</body>
</html>