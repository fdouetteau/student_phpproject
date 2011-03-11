<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/style.css" />
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
			<h1>Bienvenue sur Game On!!!</h1>
			<div class="content">
				
				<h2>Découvez ou redécouvrez vos jeux favoris</h2>
				<br/>Sur Game On, première plate-forme e-commerce de jeux vidéos en Europe, vous allez pouvoir découvrir ou redécouvrir tous vos jeux préférés: rétro-gaming et jeux récents. Tout ici est fait pour que vous puissiez passer des heures et des heures dans votre canapé devant votre console ou alors bien au chaud devant votre ordinateur.<br/>
Laissez vous tenter...<br/><br/>
<form method=get action=projet_all.php>
	<input type="submit" value="Découvrez nos jeux" class="button" />
</form><br/>
			</div>
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
