<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tykayn timeline test</title>
        <link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design_help-timeline.css" />
        <link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="style.css" />
        <link rel="shortcut icon" type="x-icon/png" href="img/favicon.png" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="timeline.js"></script>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    </head>
    <body>

        <?php
       // error_reporting(E_ALL);
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
                include('arrays.php');

                //	print_r($_GET);
                function curPageURL() {
                    $pageURL = 'http';
                    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
                        $pageURL .= "s";
                    }
                    $pageURL .= "://";
                    if ($_SERVER["SERVER_PORT"] != "80") {
                        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
                    } else {
                        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                    }
                    return $pageURL;
                }
                ?>
                <fieldset>
                    <legend>Remplissez les champs suivants</legend>
                    <form method='get' action='test.php'>
                        <?php
                        
                        $histoire_fr = array(
"0000,0032" =>"époque de JC",
"0500" =>"rome ne règne plus, Clovis est roi des francs. Ses descendants s'entretuent.",
"0800" =>"Carlemagne est empereur. Ses descendants s'entr'égorgent.",
"1000" =>"Hugues Capet, premier roi capétien.",
"1100" =>"Début des croisades",
"1200" =>"Philippe Auguste, premier roi de France de quelque circonstance.",
"1300" =>"Philippe le Bel sonne la fin des croisades.",
"1337,1453" =>"guerre de Cent Ans. la dynastie des Plantagenêts (en) VS celle des Valois (fr) ",
"1350" =>"la poste noire est de retour",
"1430" =>"Jeanne d'Arc passe et trépasse, mais sauve la France de l'Anglois.",
"1475" =>"Louis XI termine la guerre de Cent Ans",
"1515" =>"à Marignan, victoire du splendide Fançois 1er. La Renaissance arrive en France. Les guerres de religion aussi.",
"1572" =>"Massacre de saint Barthélémy, pinacle des guerres de religion.",
"1610" =>"mort d'Henri 4, son fils Louis 13 a neuf ans",
"1643" =>"mort de Louis 13, son fils Louis 14 a cinq ans",
"1638-09-05,1715-09-01" =>"Louis 14, dit Louis le Grand ou le Roi-Soleil",
"1660" =>"Louis 14 se marie et prend les rênes du pouvoir.",
"1715" =>"Mort de Louis 14, son arrière petit fils Louis 15 a cinq ans",
"1777" =>"Mort de Louis 15, son petit fils Louis 16 a vingt ans.",
"1789" =>"Révolution Française",
"1792-09-21" =>"les députés de la Convention, réunis pour la première fois, décident à l'unanimité de l'abolition de la monarchie constitutionnelle en France",
"1804" =>"Un Bonaparte se couronne empereur lui même.",
"1852" =>"Un autre Bonaparte s'auto-couronne empereur.",
"1870" =>"Fin de la guerre contre la Prusse, fin de l'empire, fin de la Commune. La république viendra un an plus tard.",
"1792,1804" =>"1e république Française.",
"1848-02-24,1852-12-02" =>"2e république Française.",
"1870,1940" =>"3e république Française.",
"1946,1958" =>"4e république Française.",
"1958,".date('Y') =>"5e république Française.",
);
                        
                        
                     $tableau['1900-01-01,2000-01-01'] =  'grande durée';
                              $tableau['1789-07-14'] =  'ceci est une révolution Française';
                              $tableau['1983-03-06'] =  'premier téléphone mobile lancé, le Motorola DynaTAC 8000X';
                              $tableau['1960-01-01'] =  'Simula, le premier langage orienté objet';
                              $tableau['1752-01-01'] =  'Benjamin Franklin fait n\'importe quoi avec la foudre';
                              $tableau['1769-01-01'] =  'Joseph Cugnot présente son « fardier à vapeur », un chariot sur lequel il monte une chaudière à vapeur. Il atteint 4 km/h et a une autonomie de 15 minutes.';
                              $tableau['1946-01-01'] =  'Les 10 000 premières Volkswagen Coccinelle sont construites en Allemagne.';
                              $tableau['1959-01-01'] =  'le Japon eut commencé en 1959 la construction du premier train à grande vitesse au monde.';
                              $tableau['1898-10-04,1900-07-19'] =  'début travaux métro de Paris';
                              $tableau['1900-07-19'] =  'ouverture première ligne de métro de Paris';
                              $tableau['1794-01-01,1848-01-01'] =  'Claude Chappe crée le réseau du télégraphe';
                              $tableau['1914-09-01,1918-01-01'] =  'WW1';
                              $tableau['1939-09-01,1945-09-02'] =  'WW2';
                              $tableau['2006-07-01,'.date('Y-m-d')] =  'Qzine';

                              $tableau[date('Y-m-d')] =  'today';
                              $tableau['1987-09-16,'.date('Y-m-d')] =  'tykayn\'s life';

                              $tableau['2013-02-16,'.date('Y-m-d')] =  'GT';
                              //        $tableau['2011-04-28,'.date('Y-m-d')] =  'GT';
                             

                              $t = new Timeline();
                            echo $t->frise($histoire_fr, "asc");
                            echo $t->css();
                            if (
                                isset($_GET['friseform']) && $_GET['friseform'] == 'yay') {
                            $tableau = array();
                            $tableau[$_GET['un']] = $_GET['un_t'];
                            $tableau[$_GET['deux']] = $_GET['deux_t'];
                            $tableau[$_GET['trois']] = $_GET['trois_t'];
                                      
                            echo"owaiii! vous pourrez même faire passer cette frise à vos amis avec ce lien: <input type=url value=' " . curPageURL() . " '/>";
                            ?>
                            <input type=date name="un" placeholder='date' required value="<?php echo $_GET['un']; ?>"/>
                            <input type=text name="un_t" placeholder='description'value="<?php echo $_GET['un_t']; ?>"/><br/>

                            <input type=date name="deux" placeholder='date' required value="<?php echo $_GET['deux']; ?>"/>
                            <input type=text name="deux_t" placeholder='description' value="<?php echo $_GET['deux_t']; ?>"/><br/>

                            <input type=date name="trois" placeholder='date' required value="<?php echo $_GET['trois']; ?>"/>
                            <input type=text name="trois_t" placeholder='description' value="<?php echo $_GET['trois_t']; ?>"/><br/>
                            <?php
                        } else {
                            ?>
                            <input type=date name="un" placeholder='date' required />
                            <input type=text name="un_t" placeholder='description'/><br/>

                            <input type=date name="deux" placeholder='date' required />
                            <input type=text name="deux_t" placeholder='description' /><br/>

                            <input type=date name="trois" placeholder='date' required />
                            <input type=text name="trois_t" placeholder='description' /><br/>
    <?php
}
?>
                        <input type=submit value="envoyer la purée">
                        <input type=hidden name="friseform" value="yay" /></form>
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
?>

</body>
</html>
