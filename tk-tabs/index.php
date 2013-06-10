<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design.css" />
		<link rel="shortcut icon" type="x-icon/png" href="icon.png" />
    </head>
    <body onload="prettyPrint();">
		
		<a href="http://artlemoine.com"><img src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png" alt="favicon "/> Portfolio de Baptiste Lemoine<br/>http://artlemoine.com </a>
		<h1>Démo et mode d'emploi des TKtabs</h1>
		
		
		
		
		<?php
		// put your code here
		include'class.tktabs.php';
		
		$tableau = array(
			'Télécharger TkTabs'=>'http://artlemoine.com/medias/apps/tk-tabs/class.tktabs.txt',
			'site de l\'auteur http://artlemoine.com'=>'http://artlemoine.com',
			'Démo et FAQ'=>'',
			'lien pour le fun', 'a'=>'ahahah','Tu peux cliquer'=>'owi bravo'
			);
		$tab = new tab();
		echo $tab->maketab($tableau);

if(isset($_REQUEST['p']) && $_REQUEST['p']!='')
{
	echo"<h2 class='bravo'>Bravo tu as cliqué sur un lien menant vers <i> $_REQUEST[p]</i></h2>";
}
		?>
		
	
	<quote class="bravo">
		<h2>à quoi ça sert?</h2>
		TKtabs fait <strong>un menu à onglets</strong> en associant un nom à une page grâce à
		un array('nom onglet'=>'lien') et pour chaque onglet une <strong>détection de l'onglet actif</strong> selon $_REQUEST['p'].<br/>
  Important: des tableaux simples avec des entrées associatives sont possibles. Les parties simples lieront vers une page du même nom.
  </quote>
	<h2>Comment le mettre en place?</h2>
	<h3>Version courte</h3>
	<code class="bravo prettyprint">
		<?php 		echo htmlspecialchars("<?php"); ?>
		<br/>
		include'class.tktabs.php';<br/>
		$tableau = array(
			'accueil'=>'',
			'CV'=>'squadala',
			'Commande',
			'galerie'
			);<br/>
	$tab = new tab();<br/>
	echo $tab->maketab($tableau);<br/>
	<?php echo htmlspecialchars("?>"); ?>
	</code>
	Ce qui donne ceci:
	<?php
$tableau = array( 'accueil'=>'', 'CV'=>'squadala', 'Commande', 'galerie' );
$tab = new tab();
echo $tab->maketab($tableau);
?> 
	
	<h3>Version détaillée</h3>
	
		Dans une page php, donc entre 
		
		<?php echo htmlspecialchars("<?php et ?>"); ?>
		, inclure la classe.<br/>
		<code class="prettyprint">include'class.tktabs.php';</code>
		Créez un tableau associatif où un nom à afficher est associé à une page cible. (si vous voulez utiliser un apostrophe écrivez-la avec un antislash \' avant pour ne pas créer d'erreur) <br/>
		<code class="prettyprint">$tableau = array(<br/>
			'Free DL'=>'free-dl',<br/>
			'CV'=>'cv',<br/>
			'Commande'=>'coms',<br/>
			'galerie'=>'gal'<br/>
			);</code>
		Un tableau simple (non associatif) sera interprêté comme si il associait des pages du même nom que ce qui est affiché.<br/>
		Ce tableau:
		<code class="prettyprint">
		$tableau = array(
			'downlad',
			'CV',
			'Commande',
			'galerie'
			);
			</code>
		...équivaut à ce tableau là:
		<code class="prettyprint">$tableau = array(<br/>
			'downlad'=>'downlad',<br/>
			'CV'=>'CV',<br/>
			'Commande'=>'Commande',<br/>
			'galerie'=>'galerie'<br/>
			);</code>
		Instancier un objet tktabs.
		<code class="prettyprint">$tab = new tab();</code>
		Générer une barre de navigation selon un tableau.
		<code class="prettyprint"> echo $tab->maketab($tableau);</code>
		Notez que vous pouvez générer plusieurs barres de menu avec le même objet.
		<h3>Pour les URL absolues</h3>
		Elles ciblent bien des url absolues et NON des liens vers ?p=http://
		Enfin, n'oubliez pas de personnaliser vos tabs avec du css ;)
		have fun!
		<h3>Définir la variable d'URL à tester</h3> Par défaut c'est "p". Si vous voulez prendre une autre, par exemple "categorie", faites ceci:
		<code class="prettyprint">
		include'class.tktabs.php';
		$tabs = new tab();
		$tabs->$url_var = 'categorie';
		</code>
		Sur ce, amusez vous bien avec vos menus de navigation.
		Merci de faire un lien vers mon site si cette classe vous a été utile, vous n'êtes pas obligés mais c'est toujours sympa :)
		<code> <?php echo htmlspecialchars('<a href="http://artlemoine.com">Portfolio de Baptiste Lemoine</a>'); ?></code>
		<div class="bravo">
		<?php include('../list.php'); ?>
			<h2>site de l'auteur</h2>
<a href="http://artlemoine.com"><img src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png" alt="favicon "/>Portfolio de Baptiste Lemoine<br/>http://artlemoine.com </a>
		</div>
    </body>
</html>
