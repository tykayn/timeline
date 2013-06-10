<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design.css" />
		<link rel="shortcut icon" type="x-icon/png" href="icon.png" />
    </head>
    <body>
		<?php
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		?>
		<div class="top">
		<img src="icon.png" alt="icone"/>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine</a>
		<a href="#dl"> Télécharger</a>
		<a href="#exemple"> Exemple</a>
		<a href="#options"> Options</a>
		<a href="#style"> style</a>
	
		</div>
		<div class="content">
		<div class="main">
		<?php
	include('function.timeshow.php');
	$tableau = array(
		"00-07" => "c'est la nuit, va te coucher!",
		"08-12" => "bon matin!",
		"12-18" => "bien l'bonjour!",
		"18-23" => "bonsoir, va falloir aller dormir là",
			);

		$tableau_accueil = array(
		"00-07" =>'<img alt="yeee"class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/lune-nuit.png"/>',
		"07-08" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/miam.png"/>',
		"08-09" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/lune_claire.png"/>',
		"09-12" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/miam.png"/>',
		"12-13" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/miam.png"/>',
		"13-16" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/sun.png"/>',
		"16-19" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/lune_claire.png"/>',
		"19-21" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/lune_verte.png"/>',
		"21-24" => '<img class="flgauche" src="http://artlemoine.com/decoration/templates/clair/heures/lune-ronde.png"/>'
			);
			
	
	//	print_r($tableau_accueil);
			$timeshow = new timeshow();
		
			
			?>
			
		<h1 ><?php echo $timeshow->build($tableau_accueil) ;?>Time show TK</h1>
		<a id="dl" href="function.timeshow.zip"><img alt="télécharger l'application random picture" src="http://artlemoine.com/decoration/dl.png"/>Télécharger la classe php</a><br/>
		Bienvenue dans l'aide de Time show, la classe PHP permettant de retourner un contenu différent en fonction de l'heure qu'il est.<br/>
		Il suffit de créer un tableau associant une plage horaire séparée par un tiret (<i>heureMin-heureMax</i>) et un contenu.<br/>
		La plage horaire est testée en incluant l'heure la plus petite et en excluant la plus grande.<br/>
		<h2 id="exemple">Exemple</h2>
		<?php	echo 	$timeshow->build($tableau).'<br/>';	?>
		Ce message change en fonction de l'heure.<br/>
		J'ai créé un tableau qui affiche:
		<br/>"c'est la nuit, va te coucher!" entre minuit et 7h du matin,
		<br/>"bon matin!" entre 7h et midi,
		<br/>"bien l'bonjour!" entre midi et 18h,
		<br/>"bonsoir, va falloir aller dormir là" entre 18h et 23h,<br/>
					
		Avec ce code php:
		<code>
		
	<br/>include('function.timeshow.php');
	<br/>$tableau = array(
	<br/>	"00-07" => "c'est la nuit, va te coucher!",
	<br/>	"07-12" => "bon matin!",
	<br/>	"12-18" => "bien l'bonjour!",
	<br/>	"18-23" => "bonsoir, va falloir aller dormir là",
	<br/>		);
	<br/>$timeshow = new timeshow();
	<br/>	echo $timeshow->build($tableau);
	<br/>
			
		</code>
		<h2 id="options">Options</h2>
		<fieldset><strong>build</strong>($array,$more=0)</fieldset>
		Une option "more" définie à "1" vous permet d'afficher de nombreuses infos supplémentaires qui vous renseigneront sur l'heure, le jour, le timestamp courant et le fuseau du serveur où le script est exécuté. Utile pour débugguer.<br/>
		Il faudra l'écrire en PHP comme ceci:
		<code>
		echo $timeshow->build( $tableau , 1); 
		</code>
		Ce qui donne:
		<?php echo $timeshow->build( $tableau , 1);  ?>
		<h2 id="style">style</h2>
		Le style CSS appliqué à chaque contenu retourné est une classe nommée "<strong>timeshow</strong>" sur une balise span.<br/>
		Avec l'activation de l'option pour en voir plus, c'est une classe nommée "<strong>timeshow_more</strong>" appliquée sur une balise fieldset.<br/>
		J'ai défini ces styles cSS pour ces deux classes:<br/>
		
		<code>
		.timeshow{
	<br/>	color:#222;
	<br/>	font-weight:bold;
	<br/>	border-radius:5px;
	<br/>	}
	<br/>	.timeshow_more{
	<br/>	background:#AFE2FF;
	<br/>	border-radius:5px;
	<br/>	}
		</code>
		Et voilà, bon fun à vous!
		
		
		<div class="foot">
		<?php include('../list.php'); 
		include_once('../classes/class.tribune.php');
		$tribune = new tribune();
		 //$this->post_contenu.= $tribune->admin();
	//	echo $tribune->comform('timeshow');
		 ?>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine<br/>http://artlemoine.com </a>
		</div>
</div>
</div>
    </body>
</html>
