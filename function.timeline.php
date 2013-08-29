<?php

abstract class timeline {

    public function _construct() {
        $GLOBALS['taille_bloc'] = 400; // tialle d'un bloc déplié, sert à les marquer de classe "ending" et les déplier sur la gauche
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
        $nb_jours = timeline::convert($date_end) - timeline::convert($date_start);
        if ($nb_jours != 0) {
            return timeline::convert($date_end) - timeline::convert($date_start); // jours
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
        $entre_deux = timeline::entre_deux($date, date('Y-m-d'));
        //        echo ' entre deux: '. $entre_deux;
        $texte = 'il y a '; //passé
        if ($entre_deux < 0) {
            $texte = 'dans'; //futur
        } elseif ($entre_deux == 0) {
            return 'Aujourd\'hui';
        } else {
            return $texte . timeline::formatTo($entre_deux);
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

        if (preg_match("/^(\d{4}-\d{2}-\d{2})|(\d{2}\/\d{2}\/\d{4})$/", $string_date)) { //   "/^\d{4}-\d{2}-\d{2}(,\d{4}-\d{2}-\d{2})?$/"
            $boom = explode('-', $string_date); // YYYY-MM-JJ
            if (strpos($string_date, '/') !== false) {  // TODO prendre en compte la syntaxe yyyy/mm/jj
                $boom = explode('/', $string_date); // JJ/MM/YYYY
                $mois = $boom[1];
            } else {
                $mois = $boom[1];
            }
  //            echo '<br/> '.$string_date.' ,mois: '.$mois . ' jours dans mois: ' . $jours_dans_mois[$boom[1]];

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
     * @return type
     */
    function displaybloc($arr_bloc, $px = 100, $customclass = "") {
        $GLOBALS['taille_bloc'] = 400;
        $taille_bloc = $GLOBALS['taille_bloc'];
        $px_left = $px;
        $end = "";
        $classe = "";
        $diff = 1;
        if ($arr_bloc['end'] != $arr_bloc['start']) {
            $debut = timeline::convert($arr_bloc['start']);
            $fin = timeline::convert($arr_bloc['end']);
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
        $diff_j = timeline::entre_deux($arr_bloc['start'], $arr_bloc['end']);
        if ($diff_j > 0) {
            $duree = timeline::formatTo($diff_j) . ', ';
        }
        //test si on doit faire déplier le bloc sur la gauche car trop à la fin de la frise pour être visible
        // si les $px sont a moins de la taille du bloc déplié
        //  $debug .=" left: $px_left , taille frise: $GLOBALS[taille_frise] , taille bloc: $taille_bloc ";
        echo " <br/>left: $px_left , taille frise: $GLOBALS[taille_frise] , taille bloc: $taille_bloc ";
        if ($px_left > ($GLOBALS['taille_frise'] - $taille_bloc)) {
            $classe .= "ending";
        }

        return ' 
        <div class="timelinebloc box-frise ' . $classe . ' ' . $customclass . '" style=" left: ' . $px_left . 'px; position : absolute;' . $end . '" data-jours="' . $diff_j . '" >
                <div class="peak" style=" left: ' . $px_left . 'px; position : absolute;"></div>
                 <div class="timeline_period_line" style="' . $end . '">
                 </div>
                 
                 <div class="timeline_head">
                    ' . $arr_bloc['date'] . ', ' . $duree . timeline::ecart($arr_bloc['start']) . '
                    
                 </div>
                 <div class="timeline_content" title="' . $arr_bloc['date'] . ' , ' . $arr_bloc['content'] . '">
                     ' . $arr_bloc['content'] . '
                        
                 </div>
            </div>';
        /* infos visibles dans le contenu
          <hr/>
          entre deux:  '.timeline::entre_deux($arr_bloc['start'] , $arr_bloc['end']).'
          <br/>  équivalent a '.$px.' px
         */
    }

    public function frise($array, $order = "asc", $taille_frise = 900, $op = 0) {
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

            //    $debug .="<br/>K $k";
            //test si une durée de deux dates séparées par des virgules est donnée
            if (strstr($k, ',')) {
                //cas d'une durée

                $boom = explode(",", $k);

                $an_start = explode("-", $boom[0]);
                $an_start = $an_start[0];
                $an_end = explode("-", $boom[1]);
                $an_end = $an_end[0];
                $tab_debut = explode("-", $boom[0]);
                $tab_fin = explode("-", $boom[1]);
                $t_dates[$an_start] = $an_start;
                $t_dates[$an_end] = $an_end;
            } elseif (strstr($k, '/') OR strstr($k, '-')) {
                // $boom = explode("/", $k);
                // TODO gérer les dates /
                $boom = explode("-", $k);

                $stamp = mktime(0, 0, 0, $boom[1], $boom[0], $boom[2]);

                $t_dates[max($boom)] = max($boom);
            } else {
                die("<div class='info'> $k est un mauvais format de date. Veuillez entrer des dates tel que JJ/MM/AAAA ou bien JJ/MM/AAAA,JJ/MM/AAAA pour les durées</div>");
            }
//		echo "<br/>$k stamp $stamp ";
//	if(!isset($tabstamps[$stamp])){$tabstamps[$stamp] ='';}
            $tabstamps[$stamp] = $v;
            $tabstampsk[] = $stamp;

//	echo "<br/>$k $stamp ,";
//	print_r($tabstampsk);
        }  //fin de l'examen du tableau
        // définir l'écart de date maximum
        //  si une seule année : 365 j

        $largeur = 365; // minimum en jour pour la largeur , 365 jours
        $annees = ( max($t_dates) - min($t_dates) + 1 );
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
                $conversions[timeline::convert($dates_duree[0])]['content'] = $v;
                //    $conversions[ timeline::convert($dates_duree[0])]['end'] =  timeline::convert($dates_duree[1]) ;
                $conversions[timeline::convert($dates_duree[0])]['end'] = $dates_duree[1];
                $conversions[timeline::convert($dates_duree[0])]['date'] = $k;
                $conversions[timeline::convert($dates_duree[0])]['start'] = $dates_duree[0];
            } else {
                $conversions[timeline::convert($k)]['content'] = $v; // clé[jours_depuis_debut]
                $tab_jours[] = timeline::convert($k);
                $conversions[timeline::convert($k)]['date'] =
                        $conversions[timeline::convert($k)]['start'] =
                        $conversions[timeline::convert($k)]['end'] =
                        $k;
            }
        }




        $debug .= "<br/>largeur de jours $largeur";
        ksort($t_dates);
        ksort($conversions);

        $jour_max = max($tab_jours);
        $frisewidth = $taille_frise;
        $frisecontent = "";
//echo '<pre>'.timeline::convert( date('Y-m-d')).' '.print_r($conversions, true). '</pre>';
        // ranger les évènements dans des lignes
        // selon largeur de temps et écart par rapport au début, définir le nombre de px a mettre sur la gauche
        foreach ($conversions as $k => $v) {

            $pxbloc = round($k * $taille_frise / $GLOBALS['largeur'], 0); //proportion de pixels selon le jour du bloc
            $conversions[$k]['pxleft'] = $pxbloc;
            $frisecontent .= timeline::displaybloc($v, $pxbloc);
        }
        $GLOBALS['taille_frise'] = $taille_frise;
        // ajout de marqueur du jour
        $arrrr = array();
        $arrrr['content'] = ' Aujourd\'hui';
        $arrrr['start'] = $arrrr['end'] = $arrrr['date'] = date('Y-m-d');
        $today = date('Y-m-d');
        $pxbloc = timeline::datetopx($today); //proportion de pixels selon le jour du bloc
        //  print_r($arrrr);
        $frisecontent .= timeline::displaybloc($arrrr, $pxbloc, 'marqueur today');

        $debug = '<fieldset class="debug info" ><h2>Debug</h2> année max: ' . max($t_dates) . ' et min : ' . min($t_dates) . ' <br/> ' . $debug . '</fieldset>';
        //  $debug = ''; //cacher le debug
        return '<div class="timeline-tk-container"><div class="timeline-tk" data-jours="' . $GLOBALS['largeur'] . '" data-width="' . $taille_frise . '" style="width:' . $taille_frise . 'px;">' . $frisecontent . '</div></div>'
                . '' . $debug . '';
        ;
    }

    /**
     * proportion de pixels selon le jour du bloc.
     * convertit une chaine de date en pixels a gauche dans la frise pour un bloc qui remprésenterait cette date
     * @param type $string
     */
    public function datetopx($string) {
        return round(timeline::convert($string) * $GLOBALS['taille_frise'] / $GLOBALS['largeur'], 0);
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
