
<?php


//adresses pour tester URL maker en local
$localurl='http://localhost/url_maker';

$localroot='C:\Program Files\UwAmp2\www\url_maker';

//adresse ABSOLUE du dossier où se trouve cette page sur un serveur web.
//servira à créer les URL à copier, par exemple:
// http://monsite.com/urlmaker
$disurl='http://artlemoine.com/medias/apps/url-maker/demo'; 

//adresse RELATIVE du dossier où se trouve cette page sur un serveur web 
$disrel=getcwd().'/'; 

//adresse de la page pour créer un nouveau billet de blog
$blognewposturl='post.php';


$montrer_config=1;
$montrer_debug=0;


$config_infos= nl2br("
Getcwd: ".getcwd()."
Adresse absolue: $disurl
Adresse relative: $disrel
Adresse de blog nouveau post: $blognewposturl
");
