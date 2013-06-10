<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>URL maker - help</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="../design.css" />
		<link rel="shortcut icon" type="x-icon/png" href="../favicon.png" />
    </head>
    <body>
		<div class="aide">
		<h1>Besoin d'aide?</h1>
		Aide et <a href="../">application</a> crées par <a href="http://artlemoine.com">Baptiste Lemoine</a>.
		<div class="folders"> 
			Table des matières
			<a href="#installation">Installation rapide</a>
			<a href="#utiliser">Comment utiliser URL maker?</a>
			<a href="#nommage">Conventions de nommage</a>
			<a href="#avance">installation avancée</a>
			<a href="#suivantes">Années Suivantes</a>
			<a href="#droits">Droits sur l'application URL maker</a>
			
			
		</div>
	
		<h2>à quoi sert l'application URL maker?</h2>
		<strong>à Bloguer plus facilement, plus rapidement, </strong>
		à éviter de rédiger soi même des adresses liant des images pour les poster sur son blog ou sur un forum par exemple.
		Vous pouvez lier vos images vers leur grande version, cependant il faut respecter le nommage du dossier contenant les grandes versions.
		<span class='info'>
		<h2 id="installation">Installation rapide</h2>
		<strong>Avant de pouvoir l'utiliser il faut configurer</strong> les valeurs des adresses à utiliser en éditant le fichier <i>config.php</i> (grâce à un éditeur de texte comme le bloc notes de windows ou "notepad++".)
		<br/>
		<br/>Trouvez la ligne <i>$disurl=' ';</i> et mettez entre les ' ' la bonne adresse du dossier contenant le script. Ce qui donnera par exemple <i>$disurl='http://monsite.com/urlmaker';</i> ensuite, sauvegardez.
		<br/>
		<br/>(Vous pourrez bloguer encore plus vite si vous regardez la partie installation avancée de cette aide.) Rendez vous ensuite sur la page index.php pour utiliser URL maker.
		</span>
		
		
		<h2 id="utiliser">Comment utiliser URL maker?</h2>
		URL maker explorera par défaut le dossier du mois et de l'année actuels quans vous vous rendrez sur l'index.<br/> C'est à dire actuellement: <strong> <?php 
		date_default_timezone_set('Europe/Paris');
			$amois =array(
				"01"=>"janvier",
				"02"=>"fevrier",
				"03"=>"mars",
				"04"=>"avril",
				"05"=>"mai",
				"06"=>"juin",
				"07"=>"juillet",
				"08"=>"aout",
				"09"=>"septembre",
				"10"=>"octobre",
				"11"=>"novembre",
				"12"=>"decembre"
				);
			echo date('/Y/m').$amois[date('m')]; 
		?> </strong><br/>
		Vous choisissez le dossier à analyser dans la partie Liens, vous choisissez ensuite les options d'analyse, vous validez et hop, vous n'avez plus qu'a copier coller les liens dans votre page de blog ou de site.
		<h3>Options.</h3>
		Vous avez le choix de la syntaxe dans laquelle retourner les liens: wiki selon Dotclear, BBcode selon les forums phpbb, HTML selon le W3C.
		Vous pouvez aussi choisir de lier les images à leur miniatures (voir la partie Conventions de nommage), et de donner un retour à la ligne.
		La spécification des dimensions en pixels n'est possible qu'avec une syntaxe HTML.
		<h3>Zone de texte.</h3>
		Dans cette zone de texte apparait l'adresse du dossier analysé. Vous pouvez y écrire l'aresse que vous souhaitez, ou plus simplement cliquer dans un des dossiers en lien.
		<h3>Liens.</h3>
		Dans cette partie sont listés les sous dossiers du dossier courant. Cliquer dessus permet une analyse.
		<h3>URL à copier.</h3>
		Ici apparaissent les URL des fichiers correspondants à l'analyse du dossier actuel. Il suffit de les sélectionner et les copier.
		<h2>Codes couleurs </h2>
		Les URL sont écrites avec ces codes couleurs:<br/>
		<span class="thumbimg">image de petite taille</span><br/>
		<span class="unfound">sans autre taille disponible</span><br/>
		<span class="grand">grande image</span><br/>
		
		<h2 id="nommage">Conventions de nommage </h2>
		Les grandes versions des images doivent se trouver dans un sous dossier nommé <strong>g</strong> comme grand.<br/>
		<img src="doss_g.jpg" alt="dossiers"/>
		Une autre possibilité consiste à mettre les petites versions des images dans un sous dossier nommé <strong>thumb</strong> comme apperçu en Anglais.<br/>
		<img src="doss_t.jpg" alt="dossiers"/>
		Dans tous les cas, les deux versions des images doivent avoir le même nom de fichier pour que le lien fonctionne.

		En installant URL maker vous devrez avoir des dossiers bien rangés selon ce schéma:<br/>
		un dossier par année, contenant chacun un dossier par mois.<br/>
		C'est dans ces dossiers de mois que vous mettrez les images que vous voulez lier.
		par exemple<br/>
		<i>http://monSiteWeb.com/urlMaker/2011/08aout</i><br/>
		<img src="dossiers.png" alt="dossiers"/>
		
		<h2 id="avance">installation avancée</h2>
		dans le fichier config.php vous pouvez entrer l'URL de la page où vous rédigez vos nouveaux posts.<br/>
		Par exemple: http://monblog.com/admin/nouveauPost.html <br/>
		<br/>Ensuite en vous rendant sur la page <i>double.php</i> vous aurez sur la même page URL maker en haut et votre page de post en bas. Ce qui facilite le copier coller pour faire un nouveau post de blog par exemple. Vous n'avez plus qu'a mettre cette page double.php en favori dans votre navigateur.
		
		<h2 id="suivantes">Années Suivantes</h2>
		Pour utiliser URL maker sur les années qui n'ont pas encore de dossier il suffit de décompresser le fichier dossiers.zip et renommer le dossier 2010 en l'année voulue.
		
		<h2 id="droits">Droits sur l'application URL maker</h2>
		Cette application ne peut être vendue.
		Peut être utilisée pour tous types de projets, gratuits ou commerciaux tant qu'est mentionné l'auteur <a href="http://artlemoine.com">Baptiste Lemoine</a>.
		Doit être partagé et diffusé sous les mêmes règles de partage.
		<?php
		// put your code here
		?>
		

		</div>
    </body>
</html>
