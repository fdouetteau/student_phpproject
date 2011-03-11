<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="icon" 
      type="image/png" 
      href="images/favicon.png" />
<title><?php echo $title;?></title>
<script type="text/javascript">
function deleteConfirm() {
	return confirm('Etes-vous sûr de vouloir effacer?'); 
} 
</script>
</head>
<body>
<div id="page">
	<!-- Banière Haut -->
	<div id="header">
    	<a href="projet_hp.php"><span>G</span></a>
  	</div>
	<div id="content">
		
		<!-- Menu de navigation commun à tout le site  --> 
		<div class="side_column">
			<h1>Menu</h1>
			<ul>
            	<li><form method=get action='projet_all.php'>
				<input type="submit" value="Liste des références produits" class="button"/>
				</form></li>
				<li></li>
				<li><form method=get action='package.php'>
				<input type='submit' value='Ajouter une référence produit' class="button"/>
				</form></li>
				<li><form method=get action='jeu.php'>
				<input type="submit" value="Ajouter un jeu" class="button"/>
				</form></li>
				<li><form method=get action='editeur.php'>
				<input type="submit" value="Ajouter un éditeur" class="button"/>
				</form></li>
				<li><form method=get action='plateforme.php'>
				<input type="submit" value="Ajouter une console" class="button"/>
				</form></li>
				<li></li>
				<li><a href="projet_hp.php"><img src="images/buttonRetour.png" alt="Homepage" /></a></li>
				
			</ul>
		</div>
		
		<!-- Page centrale -->
		<div id="middle" >	
			<?php echo $content;?>
			</table>
		</div>
		
		<!-- Bannière Droite -->
        <div class="side_column">
        	<img src="images/right.jpg" alt="Right Column Banner" />
		</div>
	</div>

	<div id="footer">
		<p>Game On is brought to you by Hassen Agoun, Matthieu Delporte, Marie-Cécile Huet and Samuel Marc (il est pas beau notre site M. Spanti?)</p>
	</div>
</div>
</body>
</html>
