<?php 

?>
<html>
<head>
<title>Random picture</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="shortcut icon" type="x-icon/png" href="icon.png" />
</head>
<body>

<div id="main">
<a href="http://artlemoine.com ">
<img src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png" alt="favicon "> Portfolio de Baptiste Lemoine<br>http://artlemoine.com </a>
<h1><img src="icon_random_picture.png" alt="icon_random_picture.png"/>Random picture</h1>
<a href="random_picture.txt">T�l�charger Random_picture.txt</a>.<br/>
Renommez le .txt en .php et mettez le dans le dossier h�berg� avec les images que vous voulez afficher au hasard.
<br/>
Pour pouvoir utiliser la fonction d'image al�atoire il faut l'inclure en php.<br/>
<code>< ?php <br/>
include('random_picture.php');<br/>
make_random_pic(); <br/>
? ></code>
<?php include('random_picture.php'); 
make_random_pic();make_random_pic();make_random_pic();
echo "<a href=''>D'autres images au hasard!</a>
<code> < ?php <br/>
make_random_pic();<br/>
make_random_pic();<br/>
make_random_pic();<br/>
? ></code>";
?>



<h2>Choisir le dossier</h2>
Vous pouvez prendre une image au hasard dans un sous dossier en donnant son chemin en argument<br/>
<code>< ?php <br/>make_random_pic("sous_dossier/");<br/>
? ></code><br/>
Ceci permet de ne pas avoir besoin de copier le script dans plusieurs dossiers.<br/>
<h2>En cas d'erreur</h2>
Si vous n'avez pas d'image dans le dossier o� cherche le script il vous �crira ceci:
<strong>(pas d'image dans ce dossier)</strong>
<h2>Style des images al�atoires</h2>
chaque image est retourn�e avec une classe "<i>random_picture</i>" que vous pouvez personnaliser en css.
<?php include('../list.php'); ?>
<h2>Site de l'auteur</h2>
<a href="http://artlemoine.com ">
<img src="http://artlemoine.com/decoration/templates/flowhtml5/favicon.png" alt="favicon "> Portfolio de Baptiste Lemoine<br>http://artlemoine.com </a>
</div>
</body>
</html>