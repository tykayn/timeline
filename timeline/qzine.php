<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn timeline test</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design_help-timeline.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="style.css" />
		<link rel="shortcut icon" type="x-icon/png" href="img/favicon.png" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.js"></script>
        <script type="text/javascript" src="timeline.js"></script>
    </head>
    <body>
		<?php
		error_reporting(E_ALL);
		?><div class="top">
		<img src="icon.png" alt="icone"/>
		<a href="http://artlemoine.com"><img alt="favicon " src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png"/> Portfolio de Baptiste Lemoine</a>
		<a href="#dl"> Télécharger</a>
		<a href="index.php"> mode d'emploi</a>
		</div>
		<div class="content">
		<div class="main">
		<h1 id="dl">Planning Qzine:</h1>
		
                    <?php
		require('function.timeline.php');
	//	print_r($_GET);
	function curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

         $tableau[date('Y-m-d')] =  'ce jour';
         $tableau['2013-06-02,2013-06-15'] =  nl2br('demander les liens des auteurs
Vérif stocks, rééditer des anciens zines si besoin
Finir le Q6 pardi ! 
Affichette : exprimez vous dans notre livre d\'or // Un fanzine 9e, les zines supplémentaires 8e ! // Portrait, caricature, fanart, 10e (avec exemples)
');
         $tableau['2013-06-15,2013-07-03'] =  nl2br("badges (2/3 new, le Pich'piou mieux, refaire le stock)
Poster A3 Boobs 10 exemplaires ?
Teaser et /ou Book A4
avance dédi japan
5e support à zines
marques pages (1 homme/1 femme/un OMG?)");
                  $tableau['2013-07-04,2013-07-07'] =  nl2br("Japan Expo");
                  $tableau['2013-07-08,2013-12-31'] =  nl2br("Concours de fanarts OMG
                  
recueil OMG 1
No spécial 1 l'art CULinaire
Déco de stand : Pokeball de geisha / Gode of the ring / dragon ball chapelet / sakura ? tentacules ?");
             //     $tableau['2012-07-04,2013-07-04'] =  nl2br("année");
                  $tableau['2013-06-02'] =  nl2br("touday");
	 echo timeline::frise($tableau, "asc",900);
       //  echo timeline::css(); 	
		?>
Réalisé avec la <a href="http://artlemoine.com/medias/apps/timeline/">Timeline de TyKayn.</a>, aussi disponible sur <a href="https://github.com/tykayn/timeline">github</a>.
		</div>
</div>
</div>

<?php



?>

    </body>
</html>
