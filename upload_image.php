<!-- ici, c'est pour uploader une image / c'est la page upload OK qui confirme que l'upload a bien été fait que ce soit en create ou en update  -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Game On!!!</title>
<link rel="icon" 
      type="image/png" 
      href="images/favicon.png" />
</head>
<body>
<div id="page">
	<div id="header">
    <a href="projet_hp.php"><span>G</span></a>
  	</div>
	<div id="content">
		<div class="side_column">
			<h1>Menu</h1>
			<ul>
            	<li><form method=get action='projet_all.php'>
				<input type="submit" value="Liste des jeux" class="button"/>
				</form></li>
				<li><form method=get action='jeu.php'>
				<input type="submit" value="Créer un jeu" class="button"/>
				</form></li>
				<li><form method=get action='editeur.php'>
				<input type="submit" value="Créer un éditeur" class="button"/>
				</form></li>
				<li><form method=get action='plateforme.php'>
				<input type="submit" value="Créer une console" class="button"/>
				</form></li>
				<li><form method=get action='package.php'>
				<input type='submit' value='Lier un jeu à une console' class="button"/>
				</form></li>
			</ul>
		</div>
		<div id="middle" >
<?php

$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('projet') or die('Impossible de sélectionner la base de données');

  $jeu_id = $_POST['jeu_id'];

  $file = $_FILES['image']['tmp_name']; 
  // quand on poste une image (= faire un "multipart form data), "image" est le nom du paramètre du formulaire et "tmp_name est le nom générique qui permet d'accéder aux images sur le serveur" / ça ne change pas en fonction du serveur

  $fp      = fopen($file, 'r');
  // ouvre l'image
  $content = fread($fp, filesize($file));
  // lit le contenu de l'image
  $content = mysql_real_escape_string($content);
  // on escape le contenu pour l'insérer dans la requête
  fclose($fp);
  // ferme le fichier
  
  $query = 
  
	sprintf("INSERT INTO image (jeu_id, image_contenu) VALUES ('%s',  '%s') ON DUPLICATE KEY UPDATE image_contenu='%s'", 
			mysql_real_escape_string($jeu_id), 
			$content, $content); 
			// exécution de la requête / mais attention: "on duplicate key update" parce que jeu_id est une clé primaire => il faut dire à la base de données que si la clé primaire existe déjà, on juste mettre à jour la colonne image_contenu = s'il y a déjà une omage associée au jeu, on ne va pas faire un insert, mais un update
    
  mysql_query($query) or die("Impossible d'insérer l'image: " . mysql_error()); 

  echo "<p>Insertion de la pochette effectu&eacute;e</p>"; 

  echo "<p><a href='jeu.php?jeu_id=$jeu_id'>Retour à la fiche du jeu</a></p>"; 
?>
</div>
        <div class="side_column">
        <img src="images/right.jpg" />
		</div>
		
	</div>
	
	<div id="footer">
		<p>Game On is brought to you by Hassen Agoun, Matthieu Delporte, Marie-Cécile Huet and Samuel Marc (il est pas beau notre site M. Spanti?)</p>
	</div>
</div>
</body>
</html>
