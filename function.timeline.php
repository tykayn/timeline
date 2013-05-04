<?php 
class timeline{
var $return ='';
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
public function frise($array, $order="asc", $taille_frise=1000, $op=0){
    
    print_r($array).print('<hr/>');
    
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

        $debug .="<br/>K $k";

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
                        $debug .="<br/>K ajoute $tabdurees[$k]= $duree_evenement <br/>$v dans tabdebuts[$k] = $stamp <br/>  tab_start_dure[$stamp]= $duree_evenement";
                }
                elseif(strstr($k,'/') OR strstr($k,'-')){
                        $boom = explode("/", $k);
                        $boom = explode("-", $k);
                        $stamp = mktime(0,0,0,$boom[1],$boom[0],$boom[2]);
                        
                        $t_dates[max($boom)] = $k ;
                      
                                if($boom[2]<1970){  //test d'une date avant l'époque unix
                          	$debug .="<br/> $boom[0] / $boom[1] / $boom[2] date ponctuelle avant époque unix $stamp";
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
    $annees = ( max($t_dates) - min($t_dates) );
    $largeur =  $annees * 365; // jours
    $conversions = array();
    $GLOBALS['t_dates'] =   $t_dates;
    function convert($string_date){
        
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
        
        $boom = explode('-', $string_date);
        $delta_annees =  ( max($boom) - min($GLOBALS['t_dates']) );
            //conversion des dates en partie d'année
            //ajouter le nombre de jours depuis le début de l'année en cours
            $premier_tour = 1;
                 for( $mois = $boom[1] ; $mois > 0; $mois-- ){ //ajouter tous les jours du mois pour tous les mois jusqu'a janvier
                     if( $premier_tour == 1){
                          $ajout += $mois; // ajout des jours de la date courante
                     }
                     $premier_tour = 0;
                     $ajout += $jours_dans_mois[$boom[1]] + $delta_annees * 365 ;
            }
            echo '<hr/>$ajout '.$ajout;
        return $ajout;
    }
    foreach ($array as $k => $v) {
        $ajout = 0;
        $boom = explode("-", $k);
        
        if(strstr($k,',')){
            $dates_duree = explode(",", $k);
            //TODO : jours depuis début pour les durées
            $conversions[convert($dates_duree[0])]['content'] = $v ;
            $conversions[convert($dates_duree[0])]['end'] = convert($dates_duree[1]) ;
        }
        else{
            $conversions[convert($k)]['content'] = $v ; // clé[jours_depuis_debut]
        }    
        
       
       
    }
                        
                            
  
    $debug .= "<br/>largeur de jours $largeur";
    ksort($t_dates);
    ksort($conversions);
    $debug .= "<hr/> conversions <pre>".print_r($conversions,true)."</pre> dates: <pre>".print_r($t_dates,true)."</pre><hr/>";


	if($order=="asc"){
		ksort($tabstamps);
	}
	elseif($order=="desc"){
		krsort($tabstamps);
	}
	//trouver le début du tableau
	$min = min($tabstampsk);
	//trouver la fin
	$max_stamp = max($tabstampsk);
	$largeur = $max_stamp - $min +1; //pour éviter a diviser par zéro
//	$debug .="<br/>  min:  ".date('Y/m/d', $min)." , max  ".date('Y/m/d', $max_stamp)." <br>min:  $min , max  $max_stamp	largeur $largeur";
	//	print_r($tabstamps);
	$marqueurs="<div class='marqueurs'>";
	$empreintes="<div class='empreintes'>";
	$boxes = $lines = array();
	$i=0;
	foreach ($tabstamps as $k => $v) {
		$debug.= "<br/> clé $k ";
		
		$classe_spe =$pixs = $pix_text = $pixels=$pix_text=$d_fin=$pik_fin =$pixlarge='';
		
		//si c'est une durée date('d/m/Y',$k) vaut la première partie d'une clé de tabdurees.
		$debug .="<br/> test $k dans tabdebuts";
		if(in_array($k,$tabdebuts)){
			$classe_spe ='duree';
			
			//ajout de pixels si la durée est trop courte
			if(round(($tab_start_dure[$k])*$taille_frise/$largeur, 0) < 200 ){
				$pixs =200;
			}
			else{
				$pixs = round(($tab_start_dure[$k])*$taille_frise/$largeur, 0);
			}
			//calcul de la taille en pixels pour la durée de l'évènement.
			$pixs = round(($tab_start_dure[$k])*$taille_frise/$largeur, 0);
	//	$debug.= "<br/> pixs $pixs = ($tab_start_dure[$k])*$taille_frise/$largeur ";
			$pixlarge = 'width:'. $pixs.'px';
			
			$d_fin =	'<span class="date_fin">'.date('d/m/Y',($k+$tab_start_dure[$k])).'</span>';
			$debug .="<br/>.......EST dans tabdebuts : $k $v  ";
		}
		else{
		$debug .="<br/>.......n'est PAS dans tabdebuts :  $k $v ";
		
		}
	//	$debug .= print_r($tabdebuts, true);		
			//sinon c'est un évènement ponctuel
		$part_stamp = $k - $min;
	//	if($min <0){$part_stamp = -$k;		}	
	
		$debug.= "<br/> $part_stamp = -$k eeeeeeeeeeeet ".date('d/m/Y',$k);
		$pixels = round($part_stamp*$taille_frise/$largeur, 0);

		if($taille_frise - $pixels < 200){$pix_text = $taille_frise-220;}
		else{
			$pix_text = $pixels;
		}
					
					$decalage_debut = 'style="left:' .$pix_text. 'px; '.$pixlarge.'"';
	//			$debug.= "<br/> décalage: $decalage_debut left $pix_text  px;  $pixlarge";
				
		$box_start = $pixels;
		$box_end = $pixs+$pix_text;
		$box_width = ($pixs+$pix_text)-$pixels;
		$box_content = "";
		
		$marqueurs .='<div class="pre_bulle" title="'.$v.'" style=" left: '.$pixels.'px;"></div>';
		$empreintes .='<div class="empreinte" style="left:' .$pixels. 'px; width: '.$box_width.'px;" ></div>';


if($box_width > 10){
				$pik_fin = '<div class="pik_vertical pik_fin" style=" left: '.($box_end).'px;" ></div>';
			}
	
		$boxes[$i]['start'] = $box_start;
		$boxes[$i]['width'] = $box_width;
		$boxes[$i]['end'] = $box_end;
		$boxes[$i]['contenu'] ='
			


	<div class="pik_vertical" style=" left: '.$pixels.'px;" ></div>
	'.$pik_fin .'
			<div class="bulle_optimised '.$classe_spe.'" '.$decalage_debut.'>
				<div class="date">
					'.date('d/m/Y',$k).' '.$d_fin.'
				</div>
			<div class="bulle_text"  >
			'.$v.'
			<span class="precision">'.$this->ecart(date('d/m/Y',$k)).'</span>
			</div>

</div>';
		
		$rendu_simple .= 
		
		'	
			<div class="box-frise">
			<div class="pik_vertical" style=" left: '.$pixels.'px;" ></div>
	'.$pik_fin .'
			<div class="bulle '.$classe_spe.'" '.$decalage_debut.'>
				<div class="date">
					'.date('d/m/Y',$k).' '.$d_fin.'
				</div>
			<div class="bulle_text"  >
			'.$v.'
			<span class="precision">'.$this->ecart(date('d/m/Y',$k)).'</span>
			</div>
</div>
</div>' ;
		$i++;
	}
	
	//minimisation de la hauteur prise par la frise.
	$i=1;
	$lines[0]='';
	$lines[1]='';
	$box_deja_fait = array();
	$places_prises = array();
	
	
	$j=0;
foreach ($boxes as $keybox => $valuebox) {

	if($valuebox['width'] == 0){
		$valuebox['width'] = 200;
		$valuebox['end'] += 200;
	}
	//  echo 'passage: '.$i.' , boite '.$i.'superposée. '.$keybox.' '.$valuebox.'<br/>'; 
// $lines[$keyline] .= $valuebox['contenu'];
		//ajouter à la ligne si les coordonnées de la boite ne chevauchent pas celles d'une autre
	//	print_r(count($box_deja_fait));
	
		foreach($boxes as $keyline => $valueline)
		{
 // echo 'TEST '.$keybox.'. '.$keyline.' . i = '.$i.' , j= '.$j.'<br/>'; 
					
		//	print_r($keyline);
		//test de tableau des trucs déjà inclus
		if(!in_array($valuebox['contenu'],$box_deja_fait)){
			$box_deja_fait[]=$valuebox['contenu'];
			$superposed =0;
	//		echo '     dans ligne '.$j.' : <br/>';
//			$Bstart =$valuebox['start'] ;
//			$Bend =$valuebox['end'] ;
//			$Astart =$valueline['start'] ;
//			$Aend =$valueline['start'];
			
			foreach($places_prises as $kplaces => $vplaces){
			foreach($vplaces as $kv => $vv){	
	//		echo " $kv => $vv start <br/>";
			$Bstart =$valuebox['start'] ;
			$Bend =$valuebox['end'] ;
			$Astart =$valueline['start'] ;
			$Aend =$valueline['start'];
				if(
						($Bstart < $Astart && $Bend < $Astart)
						||
						 ($Aend < $Bstart && $Aend < $Bend )
						 ){
					//si ça chevauche pas on met dans la ligne courante
						$lines[$j-1] .= $valuebox['contenu'];
			//		  echo 'BOX: start '.$valuebox['start'].' end '.$valuebox['end'].' . LINE! start '.$valueline['start'].' end '.$valueline['end'].' . non superposée.  mis dans la ligne '.($j).'<br/>'; 
					
				 }
				 else{

					// ça chevauche, rajouter la boite dans la ligne actuelle
					 $lines[($j)] .= $valuebox['contenu'];

		//			 echo 'start '.$valuebox['start'].' end '.$valuebox['end'].' chevauchante. mis dans la ligne '.($j+1).'<br/>';
					$superposed =0;
				 }
				 
			$places_prises[$j][] = $Bstart .'-'. $Bend;
			
			}
			}
			$j++;
		}
	
		 	
		}

	$i++;	

	}
 // print_r($places_prises);


	//affichage des lignes organisées.
	foreach ($lines as $key => $value) {
		$return .= '<div class="box-frise_op">'.$value.'	</div>';
	}
	
	//rajoute l'empreinte du jour actuel
	$pixels = round((time()-$min)*$taille_frise/$largeur, 0);
	$box_width = round((time()-$min)*$taille_frise/$largeur, 0);
	$empreintes .='<div class="empreinte_today" style="background:orange !important; left:' .$pixels. 'px; width: 2px;" ></div>';
	$pixels_today = $pixels ;
	$marqueurs.="</div>";
	$empreintes.="</div>";
	
	if($op == 1){
		$this->$return = 
			"<h2>Optimisé</h2>
			<div class='timeline-tk_op' style='width: $taille_frise"."px; height: ".($i*200)."px'>
		".$marqueurs.$return.$empreintes."
			</div>";
		
			} else{
	// <h2>Simple</h2>
	$this->$return =
//	$debug.
	"
			<br/>
			
			<div class='timeline-tk' style='width: $taille_frise"."px;'>
		".$marqueurs.$rendu_simple.$empreintes."
			</div>
	";
	
	}
	
        $debug = '<fieldset class="debugland">'.$debug.'</fieldset>';
        return $this->$return.$debug;

}
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
		 * @return donne le nombre de jours entre deux dates
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
}
.box-frise{
	background: #fff;
	padding:5px 0;
	/*    border: 1px solid orange; */
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
	}
?>