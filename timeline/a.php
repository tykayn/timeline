<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design_help-timeline.css" />
		<link rel="shortcut icon" type="x-icon/png" href="img/favicon.png" />
    </head>
    <body>
		<?php
		// put your code here
		?><div class="top">
		<img src="icon.png" alt="icone"/>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine</a>
		<a href="#dl"> Télécharger</a>
		<a href="#exemple"> Exemple</a>
		<a href="#tableau"> Le tableau d'évènements</a>
		<a href="#options"> Les options</a>
		<a href="#autres_methodes"> Les autres méthodes</a>
		</div>
		<div class="content">
		<div class="main">
		<h1 id="dl">Timeline TK</h1>
		<?php 
		include('function.timeline.php');
$tableau2 = array(
		
		date('d/m/Y') => "today ",
		"03/09/1939,02/09/1945" => "2nde guerre mondiale",
		"03/09/1970,02/09/1980" => "op",
		"03/09/1900,03/09/1920" => " 03/09/1900,03/09/1920 op",
	//	"031900031920" => " 03/09/1900,03/09/1920 op",
		"23/04/1858" => "Max planck",
			);
		$tableau = array(
		
		"12/08/2018" => "plus tard "
			);

		$timeline = new timeline();
		echo $timeline->frise($tableau2, "asc",940);
		echo $timeline->css(); 
		?>
		</div>
</div>
</div>
    </body>
</html>
