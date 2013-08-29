<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design_help-timeline.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="style.css" />
		<link rel="shortcut icon" type="x-icon/png" href="icon.png" />
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.js"></script>
        <script type="text/javascript" src="timeline.js"></script>
        
    </head>
    <body>
    <?php
   // error_reporting(E_ALL);
    date_default_timezone_set('Europe/Paris');
    require('sidefunction.php');
    
    ?>
		<div class="top">
		<img src="icon.png" alt="icone"/>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine</a>
		<a href="#dl"> Télécharger</a>
		<a href="#exemple"> Exemple</a>
		<a href="#tableau"> Le tableau d'évènements</a>
		<a href="#options"> Les options</a>
		<a href="#autres_methodes"> Les autres méthodes</a>
		<a href="#test"> Testez !</a>
		</div>
		<div class="content">
		<div class="main">
		<h1 id="dl">Timeline TK</h1>
		<!-- <a href="function_timeline.zip"><img alt="télécharger l'application random picture" src="http://artlemoine.com/decoration/dl.png"/>Télécharger la classe php</a><br/>-->
		Bienvenue dans la page d'aide de la Timeline TK.<br/>
                Code disponible et à jour sur <a href="http://github.com/tykayn" title="page github de tykayn">http://github.com/tykayn</a><br/>
		Pour utiliser cette classe il suffit de lui donner en paramètre un tableau php et de mettre en place le css.
		Si le jour actuel est présent dans la frise il est noté par une barre orange de la taille d'une journée.
		<h2 id="exemple">Exemple</h2>
		Code php:
		<code class="prettyprint linenums lang-php">
		
	<br/>include('function.timeline.php');
	<br/><br/>$tableau = array(
	<br/>	"01/01/2007,30/12/2007" => "2007",
	<br/>	date('d/m/Y') => "today ",
	<br/>	"01/01/2008,30/12/2008" => "2008",
	<br/>	"12/08/10" => "plus tard "
	<br/>		);
	<br/>		
	<br/>	timeline = new timeline();
	<br/>	echo timeline::frise($tableau, "asc",940);
	<br/>	echo timeline::css();
			
		</code>
		n'oubliez pas de faire les echo() <br/>
		Ce qui donne ceci:
		
		<?php
	include('function.timeline.php');
	$tableau = array(
		"01/01/2007,30/12/2007" => "2007",
		date('Y-m-d') => "today ",
		"01/01/2008,30/12/2008" => "2008",
		"12/08/2010" => "plus tard "
			);
        $tableau = array(
		"2007-01-01,2007-12-30" => "2007",
		date('Y-m-d') => "today "
			);
        
        
			$tableau2 = array(
		
		"23/04/1858,4/10/1947" => "
		<img src='http://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Max_Planck.png/220px-Max_Planck.png' alt='max planck portrait' height='150'/><br/>
		Max planck","14/03/1879,18/04/1955" => "<img src='http://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Albert_Einstein_Head.jpg/220px-Albert_Einstein_Head.jpg' height='150' alt='Albert Einstein portrait'/><br/>		Albert Einstein",
		"03/09/1900,02/09/1945" => "test",
		"03/09/1800,02/09/1900" => "test",
		"03/09/2000,02/09/2001" => "test",
		"03/09/1939,02/09/1945" => "2nde guerre mondiale"
			);
			$tableau3 = array(
		
		"09/11/1989" => "
		<img src='http://cache.virtualtourist.com/13/2696009-The_Berlin_Wall_Berlin.jpg' alt='icone' height='50'/>chute du mur de Berlin",
		"01/01/1982" => "
		<img src='http://www.neuroneo.com/quizzes/picture/269' alt='icone' height='50'/>
		définition du protocole Tcp/ip et du mot Internet ",
		"01/01/1991" => "
		
		<img src='http://sarreinfo.fr/services/images/site/web.gif' alt='icone' height='50'/>
		annonce publique du World Wide Web ",
		"01/04/1975" => "
		<img src='http://www.thinkervine.com/Blog/images/microsoft_logo.jpg' alt='icone' height='50'/>
		Création de Microsoft ",
		"01/06/2011" => "
		<img src='http://icdn.pro/images/fr/b/e/beos-gens-icone-7317-96.png' alt='icone' height='50'/>
		
		7 milliards d'humains"
			);
			echo 
			timeline::frise($tableau, "asc").
			timeline::css().
			'Ou encore comme ceci:'. timeline::frise($tableau, "asc");
			
			?>
		<h2 id="tableau">Le tableau d'évènements</h2>
		votre tableau de dates lié à des descriptions peut être écrit de deux façons:
		<ul>
		<li>évènement ponctuel.<br/>
		"JJ/MM/AAAA" => "description"</li>
		<li>Durée entre deux dates.<br/>
		"JJ/MM/AAAA,JJ/MM/AAAA" => "description"
		</li>
		</ul>
		Les descriptions peuvent contenir du texte, des images, des liens, ce que vous voulez.
		Par défaut les bulles d'évènement mesurent 200pixels de large.
		<h2 id="options">Les options</h2>
		 frise($array, $order="asc", $taille_frise=1000, $op=0)
		<ul>
		<li>Largeur de la frise en pixels : un nombre entier.  Par défaut: 800.</li>
		<li>Ordre des dates : asc ou desc. Par défaut: asc .</li>
		</ul>
		<h2 id="autres_methodes">Les autres méthodes</h2>
		Pour ces méthodes, les dates doivent être des chaînes de caractère et s'écrire dans le format "JJ/MM/AAAA".
		<ul>
		<li><strong>ecart</strong>( $date ) <br/>dit il y a combien de temps s'est passé ou va se passer la date entrée.</li>
		<li><strong>entre_deux</strong>( $date_start , $date_end ) <br/>donne le nombre de jours entre deux dates.</li>
		<li><strong>datejour</strong>( $date ) <br/>donne le nombre jour de la semaine (en Français) de la date.</li>
		</ul>
		<h3> Exemples</h3>
		
		
		<?php echo 'Aujourd\'hui : '.timeline::datejour(date('Y-m-d')); ?>.<br/>
		<code>echo 'Aujourd\'hui : '.timeline::datejour(date('Y-m-d'));</code><br/>
		
		<?php echo 'Le jour de ma naissance était un '.timeline::datejour('1987-09-16'); ?>.<br/>
		<code>echo 'Le jour de ma naissance était un '.timeline::datejour('1987-09-16');</code><br/>
		
		
		<?php echo 'Ce portfolio a été créé le 15/08/2009, c\'est à dire ' .
		timeline::ecart('2009-08-15').
		' et c\'était un '.timeline::datejour('2009-08-15');
		?><br/>
		<code>echo 'Ce portfolio a été créé le 15/08/2009, c\'est à dire ' .<br/> timeline::ecart('2009-08-15').<br/>' et c\'était un '.<br/>timeline::datejour('2009-08-15');</code><br/><br/>
		
		Et voici une frise pour visualiser ces données:
		<?php
	$tableau2 = array(
		"16/09/1987" => "ma naissance <img src='http://lh6.ggpht.com/_tvmQfLNuqJc/TLQ7H69-5EI/AAAAAAAANrQ/iFSGpVxwyHA/tykayn.jpg' alt='avatar'/>",
		"15/08/2009,".date('Y-m-d') => "vie du portfolio",
		date('Y-m-d') => "aujourd'hui"
			);
	echo timeline::frise($tableau2, "asc",600);
	?>
	Ce qui a été fait comme ceci:
		<code>
	$tableau2 = array(<br/>
		"16/09/1987" => "ma naissance <img src='http://lh6.ggpht.com/_tvmQfLNuqJc/TLQ7H69-5EI/AAAAAAAANrQ/iFSGpVxwyHA/tykayn.jpg' alt='avatar'/> ",<br/>
		"15/08/2009,".date('d/m/Y') => "vie du portfolio",<br/>
		date('d/m/Y') => "aujourd'hui"<br/>
			);<br/>
	echo timeline::frise($tableau2, "asc",600);
	</code>
		<br/>
		Et voilà, bonnes frises à vous.<br/>
		<h2 id="test">Testez avec vos propres valeurs</h2>
		
		<fieldset>
		<legend>Remplissez les champs suivants</legend>
		<form method='get' action='test.php'>
                    <?php if( isset($_GET['un']) && $_GET['un'] != ''){  echo '
                        
		<input type=date name="un" placeholder=date required value=" $_GET[un] "/>
		<input type=text name="un_t" placeholder="description" value=" $_GET[un_t] "/><br/>
		
		<input type=date name="deux" placeholder=date required value="$_GET[deux]"/>
		<input type=text name="deux_t" placeholder=description value="$_GET[deux_t]"/><br/>
		
		<input type=date name="trois" placeholder=date required value="$_GET[trois]"/>
		<input type=text name="trois_t" placeholder=description value="$_GET[trois_t]"/><br/>
                     '; } else{ ?>
                
                <input type=date name="un" placeholder='date' required value=""/>
		<input type=text name="un_t" placeholder='description'value=""/><br/>
		
		<input type=date name="deux" placeholder='date' required value=""/>
		<input type=text name="deux_t" placeholder='description' value=""/><br/>
		
		<input type=date name="trois" placeholder='date' required value=""/>
		<input type=text name="trois_t" placeholder='description' value=""/><br/>
                <?php } ?>
                
		<input type=submit value="envoyer la purée">
		<input type=hidden name="friseform" value="yay" />
		</form>
		</fieldset>
		
		Si vous avez des améliorations de ce script à me proposer, envoyez les moi à contact@artlemoine.com<br/><br/>
		<a href="function_timeline.zip"><img alt="télécharger l'application random picture" src="http://artlemoine.com/decoration/dl.png"/>Télécharger la classe php</a><br/>
		<br/>
		<div class="foot">
		<?php include('../list.php'); ?>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine<br/>http://artlemoine.com </a>
		</div>
</div>
</div>
    </body>
</html>
