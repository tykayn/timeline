<?php 
/* Connexion à une base ODBC avec l'invocation de pilote */
$dsn = 'mysql:dbname=tykayn;host=localhost';
$user = 'tykayn';
$password = 'plopplop01';
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
try {
    $bdd = new PDO('mysql:host=localhost;dbname=tykayn', $user,$password,$pdo_options);
	// On ajoute une entrée dans la table jeux_video
    
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
