<?php 

	/*
	* Merci de faire un lien vers mon site si cette classe vous a été utile :)
	*
	*	Affiche une image choisie aléatoirement dans le dossier où se trouve ce fichier.
	*	Pour cela, copiez ce code dans votre page HTML à l'endroit où vous voulez placer l'image aléaroire:
	*	<?php include('PATH_TO_THIS_FOLDER/random_picture.php'); ?>
	*		(pensez à remplacer PATH_TO_THIS_FOLDER par le bon chemin)
	*
	* @author TyKayn, Baptiste Lemoine
	* @filesource http://artlemoine.com
	*/


function make_random_pic($path='',$multi=0){

// corrige un slash manquant dans le chemin
if( '/' != substr($path, -1,-1)){
	$path .= '/';
}

	//scanne au hasard les sous dossiers de premier niveau si multi = 1
	if ($multi==1){
		$folders = scandir(getcwd().'/'.$path);

		//détection de dossier par l'abscence de point dans le nom de fichier
		foreach ($folders as $k =>$v){
			if(!strstr($v, '.')){
			$arr_folders[] = $v;
			}
		}
		//si y'a des dossiers on rallonge le path
		if(count($arr_folders) >0){
			$path = $path.$arr_folders[rand(0, (count($arr_folders))-1)].'/';
		}
		else{//sinon on retourne une erreur
		return" <strong>(le dossier $path n'a pas de sous dossiers)</strong>";
		}

	}
	elseif( is_array($multi)){
	//si y'a un array de dossiers on rallonge le path parmi ceux-ci
		if(count($multi) >0){
			$path = $path.$multi[rand(0, (count($multi))-1)].'/';
		}
		else{//sinon on retourne une erreur
		return" <strong>(le dossier $path n'a pas de sous dossiers)</strong>";
		}
	
	}
	$files = scandir(getcwd().'/'.$path);//scanne le dossier courant
	$formats_ok = array('.jpg','jpeg','.png','.bmp','.gif');
	$i=0;
	$clean_files = array();
			//pour chaque fichier, si c'est une image l'ajouter au tableau des random a choisir
	foreach ($files AS $k=>$v){
	$format = substr(strtolower($v),-4,4);
		if(in_array($format,$formats_ok)){
		$clean_files[$i]=$v;
		$i++;
		}
	}
	//choisit une image au hasard
	if(count($clean_files)>0){
		$random_number = rand(0, count($clean_files)-1);
		$addr = $path.$clean_files[$random_number];
		//écit le code HTML pour afficher l'image
		return"<img class='random_picture' src='$addr' title='$clean_files[$random_number]' alt='image $clean_files[$random_number]'/>";
	}
	else{
		return" <strong>(pas d'image dans le dossier $path)</strong>";
	}
}
?>