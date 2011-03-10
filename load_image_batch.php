<?php
// Connexion et sélection de la base
$link = mysql_connect('localhost', 'root', '')
    or die('Impossible de se connecter : ' . mysql_error());
mysql_select_db('mariececilehuet-projet') or die('Impossible de sélectionner la base de données');

$m = array('1' => 'image001.jpg', '2' => 'image001.jpg', '3' => 'image001.jpg'); 

foreach ($m as $jeu_id => $filename ) {
	$data = file_get_contents($filename); 
	$data = mysql_real_escape_string($data); 
	mysql_query("INSERT INTO image (jeu_id, image_contenu) VALUES
                    ('$jeu_id', '$data') ON DUPLICATE KEY UPDATE image_contenu='$data'") or die("Unable to insert data" . 	mysql_error()); 

}

?>