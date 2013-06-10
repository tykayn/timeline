
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>URL maker Tykayn</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design.css" />
		<link rel="shortcut icon" type="image/png" href="favicon.png" />
    </head>
    <body>
		
		
		

<?php 
/** URL-maker
 * @name URL-maker
 * @author Baptiste Lemoine - http://artlemoine.com
 * @version 1
 * @date August 06, 2011
 * @category web application
 * @example Visit http://artlemoine.com/medias/apps/url-maker/demo
 */

require('securite.php');
		 require'config.php';
		 
		 if($disurl==''){
			 die ("<span class='info'>Vous devez configurer l'URL à utiliser pour $disurl dans config.php pour pouvoir vous servir de URL maker. <a href='help/help.php'>Plus d'infos dans l'aide.</a></span>");
		 }
		 
				$dossiers='';
				$textes='';
				$br='';
				$lien_grand=0;
				$langage='wiki';
				$spe_dim=0;
				$largeur='';
				$hauteur='';
				$thumb=1;
				if (isset($_GET['thumb']) && $_GET['thumb']==0){ $thumb = 0;}
				$prethumb='';
				$afterthumb='';
				 $postlien = $prelien=$prehtml = $posthtml = $add = '';
				$debug ='';
				$pasfound=0;
				
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
			//localisation du dossier
			
			
				$dactuel = date('/Y/m').$amois[date('m')];
							//si y'a pas de dossier défini ET qu'il existe un dossier actuel y aller, sinon aller à la racine
							//si y'a un dossier défini aller a ce dossier
							if(isset($_GET['path']) && !empty($_GET['path'])){
								$path =$_GET['path'];
								$debug .='$path=$_GET[\'path\']';
							}
							// elseif(empty($_GET['path'])){
								// $path =getcwd().$dactuel;
								// $debug .='$path=getcwd().$dactuel';
							// }
							else{
								$path=getcwd().$dactuel;
								$debug .='$path=getcwd().$dactuel';
							}
			
			
			$corps='
				
			<h1 ><img src="favicon.png" alt="URL maker logo"/>Créateur d\'URL <span class="help"><a href="help/help.php"><img src="help/url_help.jpg" alt="URL maker aide"/>Voir l\'aide de l\'application</a></span></h1>
				
				<form method="GET" cible="index.php">
				<fieldset>
				
				<h2 id="12">Options de dossier à scanner</h2>
				<sub>Pour bien fonctionner cette page doit être placée à la racine du dossier contenant les dossiers des années, qui eux contiendront les dossiers classés par mois.</sub>
				<br/><input type="checkbox" name="backreturn" value="1" checked="checked"/> Retour à la ligne?
				<input type="checkbox" name="thumb" value="0" /> sans /thumb ou /g.
				<input type="radio" name="langage" value="wiki" checked="checked"/> WIKI 
				<input type="radio" name="langage" value="bbcode" /> BBCODE
				<input type="radio" name="langage" value="html" /> HTML<br/>
				<input type="checkbox" name="activer" value="1" /> Activer Dimensions spéciales: Largeur: <input type="text" name="largeur" value="500" /> hauteur:<input type="text" name="hauteur" value="500" /> 
				
					<textarea name="path" rows="4" cols="90">'.$path.'</textarea>
				<input type="submit" value="envoyer" />
				</form>
				
				';

				
				
				//selon les options
				
				
				//scan des dossiers

			
			$pathnormal = $path;
			$scan = scandir($pathnormal) OR die("<span class='info'> le dossier spécifié à analyser, $pathnormal , n'est pas correct.</span>");
		//	print_r($_GET);
			if(empty($scan[3])){
				$textes .="<span class='info'> le dossier spécifié à analyser, $pathnormal ne contient pas de fichiers</span>";
			}
			$dossierscanned = str_replace($disrel,'','/'.$_GET['path']);
			
			if(stristr(curPageURL(),'http://localhost')){	
																//$path =str_replace($localroot,$localurl,$path); 
															$debug.="<h2>-------LOCALHOST--------- affiché:  $path , scanné $pathnormal </h2>";
															
			}
			else{							
				$path =$disurl.$dossierscanned;
				$debug.='<h2>-------DISTANT HOTE--------- </h2>';
				
				}
				//pour éviter les double slash de fin de chemin
				$debug.=" ".substr($pathnormal,-1)." et "." hop<br/><br/><br/>";
				if(substr($pathnormal,-1)=='/'){
					$path = substr($pathnormal,0,-1);
					$debug.="un / à été retiré de pathnormal";
					
				}
				else{
					$debug.="pathnormal ne se finit pas par /";;
				}
		
				
				foreach($scan AS $k=>$v){
				//	$textes .='<br/> '.$k.' ->'.$v;
					$debug .="<br/> scan $k=>$v ";
				//si différent de . ou ..//exclut les deux 1e lignes des dossiers
					if($v != '.' && $v !='..') {
							if (preg_match("#\.|\.\.]#", $v)== TRUE) 
							{	
								//ce sont des images
								
								//texte alternatif
								$alt= substr(str_replace(array('_','-','(',')'),' ',$v), 0, -4);
								
								//selon le langage
								if(isset($_GET["langage"]) && $_GET["langage"]!='wiki'){
									//HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____HTML_____
											if($_GET["langage"]=='html'){
												$langage='html';
												$prehtml='<quote>';
												$posthtml='</quote>';
												if(isset($_GET["backreturn"]) && $_GET["backreturn"]==1){
													$br='<br/>';
													}
												if(isset($_GET["activer"]) && $_GET["activer"]=='1'){
													$spe_dim=1;
													$largeur='width="'.$_GET["largeur"].'"';
													$hauteur='height="'.$_GET["hauteur"].'"';
													}
												if( file_exists($pathnormal.'/g/'.$v)){
													$prelien='<a href="'.$path.'/g/'.$v.'">';
													$postlien='</a>';
												}
												$add = '<span class="grand">'.htmlspecialchars($prelien).'</span><span class="thumbing">'.htmlspecialchars('<img src="'.$path.'/'.$v.'" alt="'.$alt.'" title="'.$alt.'"'.$largeur.' '.$hauteur.' />'.$postlien.$br).'</span><br/>';

											}
											else if($_GET["langage"]=='bbcode'){
												
									//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____//BBCODE_____
												
												$langage='bbcode';
												if(isset($_GET["backreturn"]) && $_GET["backreturn"]==1){
												$br='<br/>';
												}
												//pour lien vers petit ou grand. test du dossier G, puis du dossier THUMB
											if($thumb==1){
																$debug.="<br/>test de $pathnormal.'/g/'.$v puis de $pathnormal.'/g/'.$v ";
												if(file_exists($pathnormal.'/g/'.$v)){
												$prethumb='[';
												$afterthumb='|'.getcwd().'/g/'.$v.']';
												$add = '[url=<span class="grand">'.$pathnormal.'/g/'.$v.'</span>][img]<span class="thumbimg">'.$path.'/'.$v.'</span>[/img][/url]'.$br;

												}
												elseif(file_exists($pathnormal.'/thumb/'.$v)){
													$add = '[url=<span class="grand">'.$pathnormal.'/'.$v.'</span>][img]<span class="thumbimg">'.$path.'/thumb/'.$v.'</span>[/img][/url]'.$br;
												}
												else{
													$add = '[img]<span class="unfound">'.$pathnormal.'/'.$v.'</span>[/img]'.$br;;
													$pasfound=1;
												}

											}
											else{
												$debug.="<br/>dossier ";
												$prethumb='<span class="unfound">';
												$afterthumb='</span>';
												$add = ''.$prethumb.'((<span class="thumbimg">'.$path.'/'.$v.'</span>|'.$alt.'|C))'.$afterthumb.$br.'<br/>';
												$pasfound=1;
											}
												
												
											}
								
									}
								else{
									//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____//WIKI_____
									
											if(isset($_GET["backreturn"]) && $_GET["backreturn"]==1){
											$br='%%%';
											}
											//pour lien vers petit ou grand. test du dossier G, puis du dossier THUMB
											if($thumb==1){
																$debug.="<br/>test de $pathnormal.'/g/'.$v puis de $pathnormal.'/thumb/'.$v ";
												if(file_exists($pathnormal.'/g/'.$v)){
												$prethumb='[';
												$afterthumb='|'.$path.'/g/'.$v.']';
												$add = ''.$prethumb.'((<span class="thumbimg">'.$path.'/'.$v.'</span>|'.$alt.'|C))<span class="grand">'.$afterthumb.'</span>'.$br.'<br/>';

												}
												elseif(file_exists($pathnormal.'/thumb/'.$v)){
													$add = '[((<span class="thumbimg">'.$path.htmlspecialchars($_GET['path']).'/thumb/'.$v.'</span>|'.$alt.'|C))|<span class="grand">'.$path.'/'.$v.'</span>]'.$br.'<br/>';
												}
												else{
													$add = '<span class="unfound">((<span class="thumbimg">'.$path.'/'.$v.'</span>|'.$alt.'|C))'.$br.'</span><br/>';
												$pasfound=1;
													
												}

											}
											else{
												$debug.="<br/>dossier ";
												$prethumb='<span class="unfound">';
												$afterthumb='</span>';
												$add = ''.$prethumb.'((<span class="thumbimg">'.$path.'/'.$v.'</span>|'.$alt.'|C))'.$afterthumb.$br.'<br/>';
												$pasfound=1;
											}
												

									}
														$textes .= $add;
															

								}
								else{
							$dossiers .= '<br/> <a href="?thumb=1&langage='.$langage.'&path='.$pathnormal.'/'.$v.'">'.$v.'</a>';
								//regroupement des textes à copier
								////sinon ce sont des dossiers
								//regroupement des liens de navigation
								}
								

								
						}
					
						
					
					
				
				

				}
				
				
	if($pasfound==1){		$textes .="<span class='info'>Certains fichiers n'ont pas de deuxième version </span>";}				
if($montrer_config==0){
	$config_infos='';
}				
if($montrer_debug==0){
	$debug='';
}							

				$corps .="</fieldset>
				<div class='results'>
				<p> $debug </p>
				<h2><a href='index.php'>home</a></h2>
				
							<div class='folders'>
								<h2>Liens dossiers</h2>
								$dossiers
							</div>
							<div class='textes' id='textes'>
								<h2>URL des fichiers à copier - $langage <input type='button' value='copy in clipboard' name='f_copier' onclick=\" copyToClipboardFF(getElementsById('textes'));\" /></h2>
				$prehtml				
				$textes
				$posthtml
				</div>
				$config_infos			
				
				</div>
				Aide et application crées par <a href='http://artlemoine.com'>Baptiste Lemoine</a>.
				Version 1
				
				<script type='text/javascript'>
				function copyToClipboardIE1(sText)
					{
					   
					   window.clipboardData.setData('Text', $textes);
					   // On ne veut pas suivre le lien après le clic.
					   return false;
					}
				function copyToClipboardFF(sText)
{
   try
   {
     
      netscape.security.PrivilegeManager.enablePrivilege(\"UniversalXPConnect\");
   }
   catch (e)
   {
      alert(\"Impossible d'accéder au presse-papier.\");
   }
  
   var gClipboardHelper =
      Components.classes[\"@mozilla.org/widget/clipboardhelper;1\"]
      .getService(Components.interfaces.nsIClipboardHelper);
   
   gClipboardHelper.copyString(sText);
   
   return false;
}
				</script>
				
				";

					echo $corps;
?>
<?php include('../../list.php'); ?>
    </body>
</html>
