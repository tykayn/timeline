<?php

namespace Tykayn\PortfolioBundle\Nav\classes;

class TL {

    private $debug = FALSE;
    private $lineHeight = 150;
    private $bonusWidth = 400;
    private $customClass = "myCustomClass";

    /**
     * set a custom class to the event blocks
     * @param string $blah
     */
    public function setCustomClass(string $blah) {
        $this->lineHeight = $blah;
    }

    public function setLineHeight(int $int) {
        $this->lineHeight = $int;
    }

    public function _construct() {
        $GLOBALS['taille_bloc'] = 400; // taille horizontale d'un bloc déplié, sert à les marquer de classe "ending" et les déplier sur la gauche
    }

    var $return = '';
    var $largeur = 800;
    var $semaine = array('', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');

    /**
     *
     * @param type $date
     * @return Donne le jour semainier de Lundi à Dimanche.
     */
    public function datejour($date) {
        $semaine = array('', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        if (strstr($date, '/')) {
            $boom = explode("/", $date);
            return $semaine[date("N", mktime(0, 0, 0, $boom[1], $boom[0], $boom[2]))];
        } else {
            $boom = explode("-", $date);
            return $semaine[date("N", mktime(0, 0, 0, $boom[1], $boom[2], $boom[0]))];
        }
    }

    /**
     * 
     * @param type $date_start
     * @param type $date_end
     * @return donne le nombre de jours entre deux dates
     */
    public function entre_deux($date_start, $date_end) {
        $nb_jours = $this->convert($date_end) - $this->convert($date_start);
        if ($nb_jours != 0) {
            return $this->convert($date_end) - $this->convert($date_start); // jours
        } else {
            return 0;
        }
    }

    /**
     * rentrer un nombre de jour, retourne dans le format désiré 
     * @param type $date
     * @param type $format
     */
    public function formatTo($date, $format = 'else') {
        if ($date != null) {
            if ($format == 'years') {
                //days to years
                return round($date / 365, 1) . ' ans';
            } else {
                if ($date < 366 && $date > 28) {
                    return round($date / 12, 1) . ' mois';
                } elseif ($date > 365) {
                    return round($date / 365, 1) . ' ans';
                } else {
                    return round($date, 1) . ' jours';
                }
            }
        } else {
            return null;
        }
    }

    /**
     *
     * @param type $date
     * @return type $string , dit combien de temps s'est passé ou va se passer une date .
     */
    public function ecart($date) {
        $entre_deux = $this->entre_deux($date, date('Y-m-d'));
        //        echo ' entre deux: '. $entre_deux;
        $texte = 'il y a '; //passé
        if ($entre_deux < 0) {
            $texte = 'dans'; //futur
        } elseif ($entre_deux == 0) {
            return 'Aujourd\'hui';
        } else {
            return $texte . $this->formatTo($entre_deux);
        }
    }

    /**
     *
     * @return donne le style pour les frises chronologiques
     */
    public function css() {
        return;
    }

    public function build($array, $order = "asc") {
        $tabstamps = array();
        $return = '';
        foreach ($array as $k => $v) {
            $boom = explode("/", $k);
            $stamp = mktime(0, 0, 0, $boom[1], $boom[0], $boom[2]);
            $debug .= "*** $k => $stamp <br/>";
            if (!isset($tabstamps[$stamp])) {
                $tabstamps[$stamp] = '';
            }
            $tabstamps[$stamp] = $v;
        }
        if ($order = "asc") {
            ksort($tabstamps);
        } elseif ($order = "desc") {
            krsort($tabstamps);
        }
        foreach ($tabstamps as $k => $v) {
            $return .='<div class="box-bulle">
                                    <div class="pik"></div>
                                    <div class="bulle">
                                        <div class="date">' . date('d/m/Y', $k) . ' ' . $this->ecart(date('d/m/Y', $k)) . '</div>
                                    <div class="bulle_text">' . $v . '</div>
                                    </div>
                      </div>';
        }
        $this->$return = $return;
        return $this->$return;
    }

    /**
     * renvoie le nombre de jours depuis le premier jour de la frise
     * @param type $array
     * @param type $order
     * @param type $taille_frise
     * @param type $op
     * @return type
     */
    function convert($string_date) {
        $ajout = 0;
        $jours_dans_mois = array(
            '01' => '31',
            '1' => '31',
            '02' => '28',
            '2' => '28',
            '03' => '31',
            '3' => '31',
            '04' => '30',
            '4' => '30',
            '05' => '31',
            '5' => '31',
            '06' => '30',
            '6' => '30',
            '07' => '31',
            '7' => '31',
            '08' => '31',
            '8' => '31',
            '09' => '30',
            '9' => '30',
            '10' => '31',
            '11' => '30',
            '12' => '31',
        );
        //gestion des formats différents de date

        if (preg_match("/^(\d{4}-\d{2}-\d{2})|((\d{2}|\d{1})\/\d{2}\/\d{4})$/", $string_date)) { //   "/^\d{4}-\d{2}-\d{2}(,\d{4}-\d{2}-\d{2})?$/"
            $boom = explode('-', $string_date); // YYYY-MM-JJ
            if (strpos($string_date, '/') !== false) {  // TODO prendre en compte la syntaxe yyyy/mm/jj
                $boom = explode('/', $string_date); // JJ/MM/YYYY
                $mois = $boom[1];
            } else {
                $mois = $boom[1];
            }
//              echo '<br/> '.$string_date.' ,mois: '.$mois . ' jours dans mois: ' . $jours_dans_mois[$boom[1]];
            if (!isset($GLOBALS['t_dates'])) {
                $GLOBALS['t_dates'] = array((date('Y') - 1) . date('-m-d') => (date('Y') - 1) . date('-m-d'));
            }
            $delta_annees = ( max($boom) - min($GLOBALS['t_dates']) );
            $delta_annees = $delta_annees * 365;
            //conversion des dates en partie d'année
            //ajouter le nombre de jours depuis le début de l'année en cours
            $premier_tour = 1;
            for ($i = $mois; $i > 0; $i--) { //ajouter tous les jours du mois pour chaque mois jusqu'a janvier
                $zeromois = $i;

                if ($premier_tour == 1) {
                    $ajout += $boom[2]; // ajout des jours de la date courante
                    $premier_tour = 0;
                } else {

                    // TODO gérer les années bissextiles
                    $ajout += $jours_dans_mois[$i];
                }
                //        echo '<br/>---- jours dans mois n° '.$i.' : ' . $jours_dans_mois[$i];
            }
            $ajout += $delta_annees;
            //     echo '<br/> ----- ajout: ' . $ajout;
            return $ajout;
        } elseif (is_int($string_date)) { // gestion de l'année si on entre un nombre sans - ou /
        } else {
            var_dump($string_date);
        }
    }

    /**
     * 
     * @param type $arr_bloc
     * @param type $px
     * @param type $customclass classe personnelle ajoutée dans le bloc
     * $number int numéro de bloc
     * @return type
     */
    function displaybloc($arr_bloc, $px = 100, $customclass = "", $number) {
        $GLOBALS['taille_bloc'] = 400;
        $taille_bloc = $GLOBALS['taille_bloc'];
        $px_left = $px;
        $end = "";
        $classe = "";
        $diff = 1;
        if ($arr_bloc['end'] != $arr_bloc['start']) {
            $debut = $this->convert($arr_bloc['start']);
            $fin = $this->convert($arr_bloc['end']);
            $diff_j = ceil($fin - $debut);
            //TODO vérifier le calcul des pixels, ça donne un truc erronné sur 100 ans
            $px = ceil($diff_j / $GLOBALS['largeur'] * $GLOBALS['taille_frise']);



            $diff = '<pre>' . $diff_j . ' sur ' . $GLOBALS['largeur'] . ' jours </pre>';
            $end = "width:" . $px . "px; "; // TODO calculer marge de hauteur selon ligne
            $classe .="periode";
            //    $debug.= '<hr/>'. $GLOBALS['taille_frise'].' pixels <hr/> '." $GLOBALS[largeur] jours de largeur = $GLOBALS[taille_frise] px ; $arr_bloc[start] = $debut à $arr_bloc[end] = $fin _______ ".''. $fin . ' - ' . $debut .' =  '.$diff_j.' jours. soit '. $px .'px sur '. $GLOBALS['taille_frise'].' pixels. (taille frise)  <hr/>' ;
        } else {
            $px = 2;
        }
        if ($arr_bloc['date'] == date('Y-m-d') || $arr_bloc['date'] == date('d/m/Y')) {
            $classe .=" today";
        }
        $duree = '';
        $diff_j = $this->entre_deux($arr_bloc['start'], $arr_bloc['end']);
        if ($diff_j > 0) {
            $duree = $this->formatTo($diff_j) . ', ';
        }
        //test si on doit faire déplier le bloc sur la gauche car trop à la fin de la frise pour être visible
        // si les $px sont a moins de la taille du bloc déplié
        //  $debug .=" left: $px_left , taille frise: $GLOBALS[taille_frise] , taille bloc: $taille_bloc ";
        //echo " <br/>left: $px_left , taille frise: $GLOBALS[taille_frise] , taille bloc: $taille_bloc ";
        if ($px_left > ($GLOBALS['taille_frise'] - $taille_bloc)) {
            $classe .= "ending";
        }

        return ' 
        
        <div class="timelinebloc box-frise ' . $classe . ' ' . $customclass . '" style=" left: ' . $px_left . 'px; position : absolute;' . $end . '" data-nb="' . $number . '" data-jours="' . $diff_j . '" >
                <div class="peak" style=" left: ' . $px_left . 'px; position : absolute;" style=" left: ' . $px_left . 'px; position : absolute;' . $end . '" data-nb="' . $number . '"></div>
                 <div class="timeline_period_line" style="' . $end . '">
                 </div>
                 
                 <div class="timeline_head">
                    ' . $arr_bloc['date'] . ', ' . $duree . $this->ecart($arr_bloc['start']) . '
                    
                 </div>
                 <div class="timeline_content" ">
                     ' . $arr_bloc['content'] . '
                        
                 </div>
            </div>';
        /* infos visibles dans le contenu
          <hr/>
          entre deux:  '.$this->entre_deux($arr_bloc['start'] , $arr_bloc['end']).'
          <br/>  équivalent a '.$px.' px
         */
    }

    public function frise($array, $order = "asc", $taille_frise = 800, $op = 0) {
        $GLOBALS['taille_frise'] = $taille_frise;
        $GLOBALS['taille_bloc'] = 400;
        //analyse de la durée
        $debug = $rendu_simple = $decalage_debut = $classe_spe = $return = $pixels = $pixlarge = $stamp_fin = $stamp = '';
        $tabdebuts = array();
        $jours_dans_mois = array(
            '01' => '31',
            '02' => '28',
            '03' => '31',
            '04' => '30',
            '05' => '31',
            '06' => '30',
            '07' => '31',
            '08' => '31',
            '09' => '30',
            '10' => '31',
            '11' => '30',
            '12' => '31',
        );
        //définir les jours entre la date la plus ancienne et la plus récente

        $t_dates = array();

        foreach ($array as $k => $v) {
            $debut_negatif = 0;
            $fin_negatif = 0;
            $stamp = '';
            $stamp_fin = '';

            if (preg_match("/^\d{4}$/", $k)) {
                $k = $k . '-01-01';
            }

            //test si une durée de deux dates séparées par des virgules est donnée
            if (strstr($k, ',')) {
                //cas d'une durée
                if (strstr($k, '-')) {
                    $boom = explode(",", $k);
                    $boom2 = explode("-", $boom[0]); // date AAAA - MM - JJ
                    $an_start = $boom2[0];
                    $boom3 = explode("-", $boom[1]);
                    $an_end = $boom3[0];
                    $tab_debut = explode("-", $boom[0]);
                    $tab_fin = explode("-", $boom[1]);
                    $t_dates[$an_start] = $an_start;
                    $t_dates[$an_end] = $an_end;
                    $stamp = mktime(0, 0, 0, $boom2[1], $boom2[2], $boom2[0]); // h, min, s, mois , jour , année
                } elseif (strstr($k, '/')) {
                    $boom = explode(",", $k);
                    $boom2 = explode("/", $boom[0]); // date JJ / MM / AAAA
                    $an_start = $boom2[2];
                    $debug .= "date:  $k ;  an start : $an_start <br/>";
                    $boom3 = explode("/", $boom[1]);
                    $an_end = $boom3[2];
                    $tab_debut = explode("/", $boom[0]);
                    $tab_fin = explode("/", $boom[1]);
                    $t_dates[$an_start] = $an_start;
                    $t_dates[$an_end] = $an_end;

                    $stamp = mktime(0, 0, 0, $boom2[1], $boom2[0], $boom2[2]); // h, min, s, mois , jour , année
                }
            } elseif (strstr($k, '/')) {
                $boom = explode("/", $k); // date JJ / MM / AAAA

                $stamp = mktime(0, 0, 0, $boom[1], $boom[0], $boom[2]); // h, min, s, mois , jour , année

                $t_dates[$boom[2]] = $boom[2];
            } elseif (strstr($k, '-')) {
                // $boom = explode("/", $k);
                // TODO gérer les dates /
                $boom = explode("-", $k); // date AAAA - MM - JJ

                $stamp = mktime(0, 0, 0, $boom[1], $boom[2], $boom[0]); // h, min, s, mois , jour , année

                $t_dates[$boom[0]] = $boom[0];
            } else {
                die("<div class='info'> $k est un mauvais format de date. Veuillez entrer des dates tel que JJ/MM/AAAA ou bien JJ/MM/AAAA,JJ/MM/AAAA pour les durées</div>");
            }
            $debug .= "<br/>$k stamp $stamp <br/>";
//	if(!isset($tabstamps[$stamp])){$tabstamps[$stamp] ='';}
            $tabstamps[$stamp] = $v;
            $tabstampsk[] = $stamp;

//	echo "<br/>$k $stamp ,";
//	print_r($tabstampsk);
        }  //fin de l'examen du tableau
        // définir l'écart de date maximum
        //  si une seule année : 365 j

        $largeur = 365; // minimum en jour pour la largeur , 365 jours
        $date_min = min($t_dates);
//        if( strpos($date_min , '/') )
//        {
//            $debug .=" date min : $date_min";
//            $boom = explode( '/' , $date_min);
//            $date_min = $boom[2];
//        }
        $annees = ( max($t_dates) - $date_min ) + 5;
        $largeur = $annees * $largeur; // jours
        $conversions = array();
        $GLOBALS['t_dates'] = $t_dates;
        $GLOBALS['largeur'] = $largeur;






        $tab_jours = Array();
        foreach ($array as $k => $v) {
            // $ajout = 0;
            $boom = explode("-", $k);

            if (strstr($k, ',')) {
                $dates_duree = explode(",", $k);
                //        $debug .= '<br/><pre>'.print_r($dates_duree , true).'  '.$dates_duree[1].' </pre>';
                //TODO : jours depuis début pour les durées
                $conversions[$this->convert($dates_duree[0])]['content'] = $v;
                //    $conversions[ $this->convert($dates_duree[0])]['end'] =  $this->convert($dates_duree[1]) ;
                $conversions[$this->convert($dates_duree[0])]['end'] = $dates_duree[1];
                $conversions[$this->convert($dates_duree[0])]['date'] = $k;
                $conversions[$this->convert($dates_duree[0])]['start'] = $dates_duree[0];
            } else {
                $conversions[$this->convert($k)]['content'] = $v; // clé[jours_depuis_debut]
                $tab_jours[] = $this->convert($k);
                $conversions[$this->convert($k)]['date'] =
                        $conversions[$this->convert($k)]['start'] =
                        $conversions[$this->convert($k)]['end'] =
                        $k;
            }
        }




        $debug .= "<br/>largeur de jours $largeur , donc $annees ans et tabjours:" . count($tab_jours);
        ksort($t_dates);
        ksort($conversions);
        if (!isset($tab_jours) || count($tab_jours) <= 2) {
            $tab_jours = array(0 => 1,
                1 => 2);
        }
        $jour_max = max($tab_jours);
        $frisewidth = $taille_frise;
        $frisecontent = "";
//echo '<pre>'.$this->convert( date('Y-m-d')).' '.print_r($conversions, true). '</pre>';
        // ranger les évènements dans des lignes
        // selon largeur de temps et écart par rapport au début, définir le nombre de px a mettre sur la gauche
        // TODO rajouter un petit pic en CSS pour les frises a décaler sur la gauche
        $i = 0;
        foreach ($conversions as $k => $v) {
            $nb_boxes = count($conversions);

            $pxbloc = round($k * $taille_frise / $GLOBALS['largeur'], 0); //proportion de pixels selon le jour du bloc
            $conversions[$k]['pxleft'] = $pxbloc;
            $frisecontent .= $this->displaybloc($v, $pxbloc, $this->customClass, $i);
            $i++;
        }
        $GLOBALS['taille_frise'] = $taille_frise;
        // ajout de marqueur du jour
        $arrrr = array();
        $arrrr['content'] = ' Aujourd\'hui';
        $arrrr['start'] = $arrrr['end'] = $arrrr['date'] = date('Y-m-d');
        $today = date('Y-m-d');
        $pxbloc = $this->datetopx($today); //proportion de pixels selon le jour du bloc
        //  print_r($arrrr);
        $frisecontent .= $this->displaybloc($arrrr, $pxbloc, 'marqueur today', $i);

        $debug = '<fieldset class="debug info well" >
          <h2>Debug</h2>
          année min : ' . $date_min . ', max: ' . max($t_dates) . '<br/> ' . $debug . '</fieldset>';

        if ($this->debug == FALSE) {
            $debug = ''; //cacher le debug
        }

        return '<div class="timeline-tk-container">
            <div class="timeline-tk" data-events="' . $nb_boxes . '" data-jours="' . $GLOBALS['largeur'] . '" data-width="' . $taille_frise . '" style="width:' . ($taille_frise + $this->bonusWidth) . 'px; height=' . $nb_boxes * $this->lineHeight . 'px ">
                ' . $frisecontent . '
                </div>
                </div>'
                . '' . $debug . '';
        ;
    }

    /**
     * proportion de pixels selon le jour du bloc.
     * convertit une chaine de date en pixels a gauche dans la frise pour un bloc qui remprésenterait cette date
     * @param type $string
     */
    public function datetopx($string) {
        return round($this->convert($string) * $GLOBALS['taille_frise'] / $GLOBALS['largeur'], 0);
    }

    /**
     * 
     * @param type $string
     * @return type
     */
    public function datetoarray($string) {
        $arr = array();
        $arr['date'] = $string;
        return $arr;
    }

    /*     * ** fin de frise *** */
}

?>
