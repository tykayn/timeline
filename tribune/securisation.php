<?php    //sécurité include('securisation.php');
foreach($_GET as $k => $v) 
{ 
	$_GET[$k] = strip_tags(htmlspecialchars($v));

} 

foreach($_POST as $k => $v) { 
	$_POST[$k] = strip_tags(htmlspecialchars($v));

} 

?>