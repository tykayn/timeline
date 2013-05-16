<?php 
abstract class timeline{
var $return ='';
var $largeur = 800;
var $semaine = array('','lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche');

    public function build($array, $order="asc"){
        $tabstamps = array();
        $return ='';
            foreach ($array as $k => $v) {
                    $boom = explode("/", $k);
                    $stamp = mktime(0,0,0,$boom[1],$boom[0],$boom[2]);
                    if(!isset($tabstamps[$stamp])){$tabstamps[$stamp] ='';}
                    $tabstamps[$stamp] = $v;
            }
            if($order="asc"){
                    ksort($tabstamps);
            }
            elseif($order="desc"){
                    krsort($tabstamps);
            }
            foreach ($tabstamps as $k => $v) {
            $return .='<div class="box-bulle">
                                    <div class="pik"></div>
                                    <div class="bulle">
                                        <div class="date">'.date('d/m/Y',$k).' '.$this->ecart(date('d/m/Y',$k)).'</div>
                                    <div class="bulle_text">'.$v.'</div>
                                    </div>
                      </div>';	
            }
            $this->$return = $return;
            return $this->$return;

    }
 /**
  * 
  * @param type $array
  * @param type $order
  * @param type $taille_frise
  * @param type $op
  * @return type
  */
    function convert($string_date){
       /**
     * renvoie le nombre de jours depuis le premier jour de la frise
     * @return \type
     */ 
        $ajout = 0;
        $jours_dans_mois = array( 
	'01'=>'31',
	'02'=>'28',
	'03'=>'31',
	'04'=>'30',
	'05'=>'31',
	'06'=>'30',
	'07'=>'31',
	'08'=>'31',
	'09'=>'30',
	'10'=>'31',
	'11'=>'30',
	'12'=>'31',
	);
      if(preg_match("/^\d{4}-\d{2}-\d{2}$/", $string_date)){ //   "/^\d{4}-\d{2}-\d{2}(,\d{4}-\d{2}-\d{2})?$/"
          $boom = explode('-', $string_date);
        $delta_annees =  ( max($boom) - min($GLOBALS['t_dates']) );
        $delta_annees = $delta_annees * 365;
            //conversion des dates en partie d'année
            //ajouter le nombre de jours depuis le début de l'année en cours
            $premier_tour = 1;
                 for( $mois = $boom[1] ; $mois > 0; $mois-- ){ //ajouter tous les jours du mois pour chaque mois jusqu'a janvier
                     if( $premier_tour == 1){
                          $ajout += $boom[2]; // ajout des jours de la date courante
                     }
                     $premier_tour = 0;
                     $ajout += $jours_dans_mois[$boom[1]]  ;
                }
                $ajout += $delta_annees;
        return $ajout;
      }  
     else{
           var_dump($string_date);
        }
    }
    

function displaybloc($arr_bloc , $px=100){
    $px_left = $px;
    $end ="";
    $classe ="";
    $diff = 1;
    if( isset($arr_bloc['end'])){
        
        $debut = explode(',' , $arr_bloc['date']);
        $debut = timeline::convert($debut[0]);

        $diff_j = ceil( $arr_bloc['end'] - $debut) ;
                
        $px= ceil($diff_j / $GLOBALS['largeur'] * $GLOBALS['taille_frise'] ) ;//* $GLOBALS['taille_frise'];
      $diff = '<pre>'. $diff_j  .' sur '.$GLOBALS['largeur'].' jours </pre>'  ;
        $end ="width:". $px ."px; "; // TODO calculer
        $classe ="periode";
        // $debug.= '<hr/>'. $GLOBALS['taille_frise'].' pixels <hr/>' ;
        // echo '<hr/>'.$arr_bloc['end'] . ' - ' . $debut .' =  '.$diff_j.' jours. soit '. $px .'px sur '. $GLOBALS['taille_frise'].' pixels.  <hr/>' ;
    }
        
    return ' <div class="timelinebloc box-frise '.$classe.'" style=" left: '. $px_left .'px; position : absolute; '.$end.'" data-jours="'.$diff.'" title="'.$arr_bloc['date'].' , '.$arr_bloc['content'].'">
                 <div class="timeline_period_line" style="'.$end.'">
                 </div>
                 <div class="timeline_head">
                    '.$arr_bloc['date'].'
                 </div>
                 <div class="timeline_content">
                     '.$arr_bloc['content'].'
                 </div>
            </div>';
}
    
public function frise($array, $order="asc", $taille_frise=1000, $op=0){
    $GLOBALS['taille_frise'] = $taille_frise;
    
	//analyse de la durée
	$debug = $rendu_simple = $decalage_debut =$classe_spe =$return = $pixels = $pixlarge = $stamp_fin = $stamp = '';
	$tabdebuts = array();
	$jours_dans_mois = array( 
	'01'=>'31',
	'02'=>'28',
	'03'=>'31',
	'04'=>'30',
	'05'=>'31',
	'06'=>'30',
	'07'=>'31',
	'08'=>'31',
	'09'=>'30',
	'10'=>'31',
	'11'=>'30',
	'12'=>'31',
	);
        //définir les jours entre la date la plus ancienne et la plus récente
        
       $t_dates = array();
        
        foreach ($array as $k => $v) {
        $debut_negatif = 0;	
        $fin_negatif = 0;
        $stamp = '';
        $stamp_fin =  '';

    //    $debug .="<br/>K $k";

                //test si une durée de deux dates séparées par des virgules est donnée
                if(strstr($k,',')){
                        //cas d'une durée

                        $boom = explode(",", $k);
                        
                        
                        $tab_debut = explode("/", $boom[0]);
                        $tab_debut = explode("-", $boom[0]);
                        $tab_fin = explode("/", $boom[1]);
                        $tab_fin = explode("-", $boom[1]);
                        $stamp = mktime(0,0,0,$tab_debut[1],$tab_debut[0],$tab_debut[2]);
                        $stamp_fin = mktime(0,0,0,$tab_fin[1],$tab_fin[0],$tab_fin[2]);
                            $t_dates[max($tab_debut)] = $k ;
                            $t_dates[max($tab_fin)] = $k ;
                                //test d'une date avant l'époque unix
                                if($tab_debut[2]<1970){
                                $debut_negatif = 1;
                                //donner un timestamp selon le nombre de jours, mois années.
                                $stamp =((($tab_debut[0])*24*3600)+(($tab_debut[1])*$jours_dans_mois[$tab_debut[1]]*24*3600)+(( $tab_debut[2])*365.2524*24*3600))*-1;				
                        //	$debug .="<br/>$k étendue -unix $stamp,$stamp_fin sta dire ".date('Y/m/d', $stamp).' à '.date('Y/m/d', $stamp_fin);
                                }
                                if($tab_fin[2]<1970){
                                $stamp_fin =((($tab_fin[0])*24*3600)+(($tab_fin[1])*$jours_dans_mois[$tab_fin[1]]*24*3600)+(( $tab_debut[2])*365.2524*24*3600))*-1;
                        //	$debug .="<br/> $k étendue -unix $stamp $stamp_fin , sta dire ".date('Y/m/d', $stamp);
                                $fin_negatif = 1;
                                }


                                $stamp_compare = $stamp;
                                $stamp_c_fin = $stamp_fin;
                                if($stamp <0){$stamp_compare = - $stamp;}
                                if($stamp_fin <0){$stamp_c_fin = - $stamp_fin;}

                                $duree_evenement = $stamp_c_fin - $stamp_compare;
                        $debug .="<br/> $duree_evenement = $stamp_c_fin - $stamp_compare";
                //	if(!isset($tabdurees[$k])){$tabdurees[$k] ='';}
                        $tabdurees[$k]= $duree_evenement;

                //	if(!isset($tabdebuts[$k])){$tabdebuts[$k] ='';}
                        $tabdebuts[$k]= $stamp;
                        $tab_start_dure[$stamp]= $duree_evenement;
                 //       $debug .="<br/>K ajoute $tabdurees[$k]= $duree_evenement <br/>$v dans tabdebuts[$k] = $stamp <br/>  tab_start_dure[$stamp]= $duree_evenement";
                }
                elseif(strstr($k,'/') OR strstr($k,'-')){
                        // $boom = explode("/", $k);
                        $boom = explode("-", $k);
                        $stamp = mktime(0,0,0,$boom[1],$boom[0],$boom[2]);
                        
                        $t_dates[max($boom)] = $k ;
                      
                                if($boom[2]<1970){  //test d'une date avant l'époque unix
                          //	$debug .="<br/> $boom[0] / $boom[1] / $boom[2] date ponctuelle avant époque unix $stamp";
                                $debut_negatif = 1;	
                                }
                }
                else{
                die( "<div class='info'> $k est un mauvais format de date. Veuillez entrer des dates tel que JJ/MM/AAAA ou bien JJ/MM/AAAA,JJ/MM/AAAA pour les durées</div>");
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

    $largeur = 365; // jours
    $annees = ( max($t_dates) - min($t_dates) +1 );
    $largeur =  $annees * 365; // jours
    $conversions = array();
    $GLOBALS['t_dates'] = $t_dates;
    $GLOBALS['largeur'] = $largeur;
    
    
    
    
    
    
    $tab_jours = Array();
    foreach ($array as $k => $v) {
       // $ajout = 0;
        $boom = explode("-", $k);
        
        if(strstr($k,',')){
            $dates_duree = explode(",", $k);
            //TODO : jours depuis début pour les durées
            $conversions[ timeline::convert($dates_duree[0])]['content'] = $v ;
            $conversions[ timeline::convert($dates_duree[0])]['end'] =  timeline::convert($dates_duree[1]) ;
            $conversions[ timeline::convert($dates_duree[0])]['date'] = $k ;
            
        }
        else{
            $conversions[ timeline::convert($k)]['content'] = $v ; // clé[jours_depuis_debut]
            $tab_jours[] =  timeline::convert($k);
            $conversions[ timeline::convert($k)]['date'] = $k ;
        }    
    }
                        
                            
  
    $debug .= "<br/>largeur de jours $largeur";
   ksort($t_dates);
    ksort($conversions);
    
    $jour_max  = max($tab_jours);
    $frisewidth = 800;
    $frisecontent = "";

    // ranger les évènements dans des lignes
        // selon largeur de temps et écart par rapport au début, définir le nombre de px a mettre sur la gauche
        foreach ($conversions as $k => $v) {
            
            $pxbloc = round( $k * $frisewidth / $largeur , 0) ; //proportion de pixels selon le jour du bloc
            $conversions[$k]['pxleft'] = $pxbloc;
            $frisecontent .= timeline::displaybloc($v , $pxbloc);
         //   $debug .= "<hr/>yeeeeee <pre>".print_r($pxbloc,true)."</pre><hr/>";        
        }
    // placement et affichage
        // TODO savoir si des évènements se superposent
    
  //  $debug .= "<hr/> conversions <pre>".print_r($conversions,true)."</pre> dates: <pre>".print_r($t_dates,true)."</pre><hr/>";
  //  $this->return = '<div class="timeline-tk">'.$frisecontent.'</div>'
         //   .$debug;
            return '<div class="timeline-tk">'.$frisecontent.'</div>';

}
/**** fin de frise ****/

		/**
		 *
		 * @param type $date
		 * @return Donne le jour semainier de Lundi à Dimanche.
		 */
		public function datejour($date){
			$boom = explode("/", 	$date);
			return 
					$this->semaine[ date("N", mktime(0, 0, 0, $boom[1],$boom[0],$boom[2])) ]
				;
		}
		/**
		 *
		 * @param type $date
		 * @return donne le nombre de jours entre deux dates JJ/MM/AAAA
		 */
		public function entre_deux($date_start , $date_end){
				
				$tab_debut = explode("/" , $date_start);
				$tab_fin = explode("/" , $date_end);
				$duree_stamp =  mktime(0, 0, 0, $tab_fin[1],$tab_fin[0],$tab_fin[2]) - mktime(0, 0, 0, $tab_debut[1],$tab_debut[0],$tab_debut[2]);
				$duree = variant_abs($duree_stamp/(3600*24));
				return "$duree jours";
				
		}	
		/**
		 *
		 * @param type $date
		 * @return dit combien de temps s'est passé ou va se passer une date .
		 */
		public function ecart($date){	
			
			$boom = explode("/", 	$date);
			$stamp =mktime(0, 0, 0, $boom[1],$boom[0],$boom[2]);
			$ecart_stamp = time() - $stamp;
			//si dans le passé
			if($ecart_stamp> 0){
					if(round(($ecart_stamp /(3600*24)),0)<7){
						return "Il y a " .round(($ecart_stamp /(3600*24)),0)." jours";
					}
					elseif(round(($ecart_stamp /(3600*24)),0)<31){
						$semaines = round(($ecart_stamp /(3600*24*7)),0);
						return "Il y a " .$semaines." semaines";
					}
					elseif(round(($ecart_stamp /(3600*24)),0)<365){
						$mois = round(($ecart_stamp /(3600*24*30.5)),1);
						return "Il y a " .$mois." mois";
					}
					else{
						$ans = round(($ecart_stamp /(3600*24*365.2425)),1);
						return "Il y a " .$ans." ans";
					}
			
			}
			elseif($ecart_stamp== 0){
			return "Aujourd'hui";
			}
			elseif($ecart_stamp< 0){
			return "Dans " .round(($ecart_stamp /(-3600*24)),0)." jours";
			}
			////sinon futur

		}
		/**
		 *
		 * @return donne le style pour les frises chronologiques
		 */
	public function css(){
echo '<style type="text/css">
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
.timeline-tk{
	background: #fff;
	padding:5px 0;
	border: 1px solid orange; 
        display: block;
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
.timelinebloc{
    padding: 0px ;
    background: #fff7db;
}
.timeline_head{
    padding: 5px 10px ;
    font-size: small;
    background: #ccc;
}
.timeline_content{
    padding: 5px 10px;
}
.periode{
    border-top:5px solid;
    border-bottom:5px solid;
}
.periode .timeline_period_line{
    display: inline-block;
    height:2px;
    min-width:1px;
    background: blue;
}
        </style>';
		}
                
}
?>