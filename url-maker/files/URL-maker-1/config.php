
<?php
/**
 * URL-maker
 * @name URL-maker
 * @author Baptiste Lemoine - http://artlemoine.com
 * @version 1
 * @date August 06, 2011
 * @category web application
 * @example Visit http://artlemoine.com/medias/apps/url-maker/demo
 */

//adresses pour tester URL maker en local
$localurl='http://localhost/url_maker';

$localroot='C:\Program Files\UwAmp2\www\url_maker';

//adresse ABSOLUE du dossier où se trouve cette page sur un serveur web. ça ne fonctionnera pas sur un autre serveur.
//servira à créer les URL à copier, par exemple:
// http://monsite.com/urlmaker  ou bien  http://artlemoine.com/medias/apps/url-maker/demo
$disurl=''; 

//adresse RELATIVE du dossier où se trouve cette page sur un serveur web 
$disrel=getcwd().'/'; 

//adresse de la page pour créer un nouveau billet de blog
$blognewposturl='post.php';

//en cas d'envie d'afficher les données de débug et de config, mettre à 1 au lieu de 0.
$montrer_config=0;
$montrer_debug=0;


$config_infos= nl2br("
Getcwd: ".getcwd()."
Adresse absolue: $disurl
Adresse relative: $disrel
Adresse de blog nouveau post: $blognewposturl
");
