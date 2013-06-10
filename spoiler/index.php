<html>
<link rel="shortcut icon" type="image/png" href="http://qzine.fr/styles/absolution/template/favicon.png" />
<head>
	<title>	spoiler	</title>
		<link rel="stylesheet" href="style_spoil.css" type="text/css" media="screen">
		<link rel="shortcut icon" type="x-icon/png" href="icon.png" />
		<style>.spoil div{display:none;}</style>
</head>
 
<body onload="prettyPrint();">
<div class="contenu">
	<h1>Boites de spoil</h1>
	Avec ce petit javascript utilisant jQuery vous allez pouvoir réaliser des espaces de contenus cachés (ou spoil).
	<div class="spoil">
	Cliquez moi pour montrer ou cacher du texte en plus
	<div> bravo! voici du texte en plus</div>
	</div>

	<div class="spoil">
	un spoil sur la bible
		<div> Jésus meurt</div>
	</div>
	<div class="spoil">
	<h2>Comment mettre en place ce système?</h2>
		<div> 
		
	Pour mettre en place ce système il suffit de suivre cette écriture dans une page HTML et d'insérer le javascript qui suit. Ce qui suit donnera l'exemple avec le spoil précédent:
	<textarea>
	<div class="spoil">
	un spoil sur la bible
		<div> Jésus meurt</div>
	</div>
	</textarea>
	Comme vous pouvez le voir il suffit de deux divisions de page imbriquées et que la première comporte une classe "spoil".
		Javascript pour ce code
		<textarea>
		
	
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript">
	$(document).ready(function(){
	$(".spoil div").hide();
	$(".spoil div").before("<span class='spoil_button'>(voir la suite)</span>");
	$(".spoil").click(function(){
	$(this).children("div").toggle("fast");
	var spoiltexte = $(this).children(".spoil_button").text();
	if(spoiltexte == "(voir la suite)"){
	$(this).children(".spoil_button").text("(cacher)");}
	else{
	$(this).children(".spoil_button").text("(voir la suite)");
	}

	});
	});
	</script>
		
		
		</textarea></div>
	</div>
	<div class="spoil prettyprint">On ne peut afficher que du texte?
		<div> on peut aussi afficher des images, et tout ce qu'on veut d'ailleurs<br/>
		<img src="img/icon_random_picture_blue.png" alt="dé bleu"/>
		<img src="img/icon_random_picture_green.png" alt="dé vert"/>
		<img src="img/icon_random_picture_orange.png" alt="dé orange"/>
		</div>
	</div>
	<div class="spoil prettyprint">
	Pourquoi pas faire un Menu
		<div> paye ton choix.
			<ul>
			<li><a href="http://artlemoine.com">mon portfolio</a></li>
			<li><a href="http://tykay.free.fr">mon blog d'art</a></li>
			<li><a href="mailto:contact@artlemoine.com">mon email</a></li>
			</ul>
			</div>
	</div>
		<div class="spoil prettyprint">
		Spoil-ception
			<div>
				<div class="spoil">
					oh encore une boite!
					<div class="spoil"> 
					<blockquote>we must go deeper!</blockquote>
						<div>
						<img src="http://rlv.zcache.com/impossibru_sticker-p217268160122202756zvfp8_400.jpg" alt="impossiburu!"/>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="spoil">
		Mes autres applis:
			<div>
				<?php include('../list.php'); ?>
			</div>
		</div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".spoil div").hide();
$(".spoil div").before("<span class='spoil_button'>(voir la suite)</span>");

$(".spoil .spoil_button").click(function(){
$(this).parent().children("div").toggle("fast");
var spoiltexte = $(this).children(".spoil_button").text();
if(spoiltexte == "(voir la suite)"){
$(this).children(".spoil_button").text("(cacher)");}
else{
$(this).children(".spoil_button").text("(voir la suite)");
}

});
});
</script>
<script type=text/javascript >

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4941415-3']);
  _gaq.push(['_setDomainName', 'artlemoine.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>