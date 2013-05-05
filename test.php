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
//echo $timeline->css(); 
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
		<i>N'oubliez pas de renseigner les dates dans le format AAAA-MM-JJ <br/>
		pour un évènement ponctuel, et 
		AAAA-MM-JJ,AAAA-MM-JJ <br/>
		pour un évènement dans la durée.</i>
		<br/>
		
		<a href="function_timeline.zip"><img alt="télécharger l'application random picture" src="http://artlemoine.com/decoration/dl.png"/>Télécharger la classe php</a><br/>
		</div>
</div>
</div>

<?php

function css(){
return'<style type="text/css">
 body{
font-family: calibri,arial; 

} 
.timeline-tk_op{

    border: 1px solid #CCCCCC;
color: #222;
padding:5px;
 /* position:absolute; */
    overflow: hidden;
	min-height:400px;

}
.timeline-tk{

    border: 1px solid #CCCCCC;
color: #222;
padding:5px;
position:relative;
overflow: hidden;
min-height: 250px;
display: block;
}
.box-frise{
	background: #fff;
	padding:5px 0;
	    border: 1px solid orange; 
        display: inline-block;
}
.box-frise_op{
    background: none repeat scroll 0 0 #FFFFFF;
	border: 1px solid red;
    margin-bottom: 0;
    min-height: 140px;
    padding: 5px 0;
    position: relative;
    top: 20px;
}
.empreintes{
    display: block;
    height: 1600px;
    margin-left: -6px;
    overflow: hidden;
    position: absolute;
    top: 25px;
    width: 100%;
    z-index: 0;

}
.empreinte{ 
	border: 1px solid #ccc;
    display: block;
    height: 1600px;
    margin-left: 6px;
   top:0;
    overflow: hidden;
    position: absolute;
    width: 100%;
    z-index: 0;
	border: 1px solid #B5CEF2;
	background: #EFEFEF;
	background: rgba(239, 239, 239,0.5);
	
}
.empreinte_today{ 
	border: 1px solid #red;
    display: block;
    height: 1600px;
    margin-left: 6px;
   top:0;
    overflow: hidden;
    position: absolute;
    z-index: 0;
	border: 1px solid #blue;
	background: orange;
	
}
.date_fin{
float:right;
}
.box-bulle{
display: block;
}
.pik_vertical{
    background-attachment: scroll;
    background-color: transparent;
    background-image: url("pik.png");
    background-position: -50px 50%;
    display: block;
    height: 40px;
    margin-bottom: -20px;
    margin-left: 0;
    position: relative;
    width: 10px;
    z-index: 1;
}
.pik{
    background: none repeat scroll 0 0 #FFFFFF;
    display: block;
    height: 30px;
    margin-bottom: -30px;
    width: 30px;
}
.pik_fin{
    background-position: 20px 50%;
    margin-bottom: -22px;
    margin-left: -7px;
    width: 10px;
}

.precision{
    color: #444444;
    display: block;
    font-size: small;
    text-align: center;
}
.date{
font-size: small;
border-radius: 10px;
background: #ccc;
padding:1px 10px;
}
.bulle{
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
	border-left: 2px solid #CCCCCC;
    display: inline-block;
	border-radius: 15px;
	position:relative;
	min-width: 200px;
	    z-index: 1;
		box-shadow: 0 0 10px #333;

}
.bulle_optimised{
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
	border-left: 2px solid #CCCCCC;
    display: inline-block;
	border-radius: 15px;
	position:absolute;
	min-width: 200px;
	    z-index: 1;
		box-shadow: 0 0 10px #333;
		top:0;

}
.bulle_optimised:hover{
    background: #D1AFAF;
    border: 1px solid #DD9D25;
	border-left: 2px solid #DD9D25;
    display: inline-block;
	border-radius: 15px;
}
.bulle_optimised:hover .date{
    background: #ddd;

}
.bulle:hover{
    background: #D1AFAF;
    border: 1px solid #DD9D25;
	border-left: 2px solid #DD9D25;
    display: inline-block;
	border-radius: 15px;
	position:relative;
}
.bulle:hover .date{
    background: #ddd;

}
.bulle_text{
	 word-wrap: break-word;
    display: block;
    padding: 10px;
	width:200px;

}

.pre_bulle{
    background: #cc0000;
    display: block;
    height: 8px;
    position: absolute;
    width: 3px;
	margin-left:4px;

}
.marqueurs{
display:block;
height:10px;

}
a{
text-decoration: none;
color: #883b12;
}
a:hover{
text-decoration: underline;
color: #e66a27;
}
.duree{
background:#AFE2FF !important;
color:#234D66;
max-width: 1000px;
	
}
.duree:hover{
background:orange !important;
}
        </style>';
		}

?>
<style type="text/css">
 body{
font-family: calibri,arial; 

} 
.timeline-tk_op{

    border: 1px solid #CCCCCC;
color: #222;
padding:5px;
 /* position:absolute; */
    overflow: hidden;
	min-height:400px;

}
.timeline-tk{

    border: 1px solid #CCCCCC;
color: #222;
padding:5px;
position:relative;
overflow: hidden;
min-height: 250px;
display: block;
}
.box-frise{
	background: #fff;
	padding:5px 0;
	border: 1px solid orange; 
        display: inline-block;
}
.box-frise_op{
    background: none repeat scroll 0 0 #FFFFFF;
	border: 1px solid red;
    margin-bottom: 0;
    min-height: 140px;
    padding: 5px 0;
    position: relative;
    top: 20px;
}
.empreintes{
    display: block;
    height: 1600px;
    margin-left: -6px;
    overflow: hidden;
    position: absolute;
    top: 25px;
    width: 100%;
    z-index: 0;

}
.empreinte{ 
	border: 1px solid #ccc;
    display: block;
    height: 1600px;
    margin-left: 6px;
   top:0;
    overflow: hidden;
    position: absolute;
    width: 100%;
    z-index: 0;
	border: 1px solid #B5CEF2;
	background: #EFEFEF;
	background: rgba(239, 239, 239,0.5);
	
}
.empreinte_today{ 
	border: 1px solid #red;
    display: block;
    height: 1600px;
    margin-left: 6px;
   top:0;
    overflow: hidden;
    position: absolute;
    z-index: 0;
	border: 1px solid #blue;
	background: orange;
	
}
.date_fin{
float:right;
}
.box-bulle{
display: block;
}
.pik_vertical{
    background-attachment: scroll;
    background-color: transparent;
    background-image: url("pik.png");
    background-position: -50px 50%;
    display: block;
    height: 40px;
    margin-bottom: -20px;
    margin-left: 0;
    position: relative;
    width: 10px;
    z-index: 1;
}
.pik{
    background: none repeat scroll 0 0 #FFFFFF;
    display: block;
    height: 30px;
    margin-bottom: -30px;
    width: 30px;
}
.pik_fin{
    background-position: 20px 50%;
    margin-bottom: -22px;
    margin-left: -7px;
    width: 10px;
}

.precision{
    color: #444444;
    display: block;
    font-size: small;
    text-align: center;
}
.date{
font-size: small;
border-radius: 10px;
background: #ccc;
padding:1px 10px;
}
.bulle{
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
	border-left: 2px solid #CCCCCC;
    display: inline-block;
	border-radius: 15px;
	position:relative;
	min-width: 200px;
	    z-index: 1;
		box-shadow: 0 0 10px #333;

}
.bulle_optimised{
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
	border-left: 2px solid #CCCCCC;
    display: inline-block;
	border-radius: 15px;
	position:absolute;
	min-width: 200px;
	    z-index: 1;
		box-shadow: 0 0 10px #333;
		top:0;

}
.bulle_optimised:hover{
    background: #D1AFAF;
    border: 1px solid #DD9D25;
	border-left: 2px solid #DD9D25;
    display: inline-block;
	border-radius: 15px;
}
.bulle_optimised:hover .date{
    background: #ddd;

}
.bulle:hover{
    background: #D1AFAF;
    border: 1px solid #DD9D25;
	border-left: 2px solid #DD9D25;
    display: inline-block;
	border-radius: 15px;
	position:relative;
}
.bulle:hover .date{
    background: #ddd;

}
.bulle_text{
	 word-wrap: break-word;
    display: block;
    padding: 10px;
	width:200px;

}

.pre_bulle{
    background: #cc0000;
    display: block;
    height: 8px;
    position: absolute;
    width: 3px;
	margin-left:4px;

}
.marqueurs{
display:block;
height:10px;

}
a{
text-decoration: none;
color: #883b12;
}
a:hover{
text-decoration: underline;
color: #e66a27;
}
.duree{
background:#AFE2FF !important;
color:#234D66;
max-width: 1000px;
	
}
.duree:hover{
background:orange !important;
}
        </style>
    </body>
</html>
