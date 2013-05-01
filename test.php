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
		<a href="index.php"> mode d'emploi</a>
		</div>
		<div class="content">
		<div class="main">
		<h1 id="dl">Timeline TK, Votre propre frise:</h1>
		<?php
		include('function.timeline.php');
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

		if(
		isset($_GET['friseform'])
		&& $_GET['friseform']== 'yay'){
		$tableau = array();
		$tableau[$_GET['un']] =  $_GET['un_t'];
		$tableau[$_GET['deux']] =  $_GET['deux_t'];
		$tableau[$_GET['trois']] =  $_GET['trois_t'];


$timeline = new timeline();
echo $timeline->frise($tableau, "asc",940);
echo $timeline->css(); 
echo"owaiii! vous pourrez même faire passer cette frise à vos amis avec ce lien: <input type=url value=' ".curPageURL()." '/>";
		}

		
		?>
		<fieldset>
		<legend>Remplissez les champs suivants</legend>
		<form method='get' action='test.php'>
		<input type=date name="un" placeholder='date' required value="<?php echo $_GET['un']; ?>"/>
		<input type=text name="un_t" placeholder='description'value="<?php echo $_GET['un_t']; ?>"/><br/>
		
		<input type=date name="deux" placeholder='date' required value="<?php echo $_GET['deux']; ?>"/>
		<input type=text name="deux_t" placeholder='description' value="<?php echo $_GET['deux_t']; ?>"/><br/>
		
		<input type=date name="trois" placeholder='date' required value="<?php echo $_GET['trois']; ?>"/>
		<input type=text name="trois_t" placeholder='description' value="<?php echo $_GET['trois_t']; ?>"/><br/>
		
		<input type=submit value="envoyer la purée">
		<input type=hidden name="friseform" value="yay" />
		</form>
		</fieldset>
		<br/>
		<br/>
		<i>N'oubliez pas de renseigner les dates dans le format JJ/MM/AAAA <br/>
		pour un évènement ponctuel, et 
		JJ/MM/AAAA,JJ/MM/AAAA <br/>
		pour un évènement dans la durée.</i>
		<br/>
		
		<a href="function_timeline.zip"><img alt="télécharger l'application random picture" src="http://artlemoine.com/decoration/dl.png"/>Télécharger la classe php</a><br/>
		</div>
</div>
</div>
    </body>
</html>
