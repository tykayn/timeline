	<?php 
	/**
 * Merci de faire un lien vers mon site si cette classe vous a été utile :)
 * @author TyKayn
 * @filesource http://artlemoine.com
 * @link http://artlemoine.com/medias/apps/timeshow/
 */
 
	class timeshow{

		public function build($array,$more=0){
		$return= $return_f ='';
		if ( $more==1){
			$return .= "<fieldset class='timeshow_more'>actuellement: ".date('Y/m/d H:i:s , r ,U ,T')."<br/>";
			}
		foreach($array as $k=>$v){
		$tab_h = explode('-',$k);

		//comparer heure actuelle avec les plages horaires du tableau
			if ( date('H')>= $tab_h[0] && date('H')< $tab_h[1]){
			$return .= '<span class="timeshow">'.$v.'</span>';
			}
		}
		if ( $more==1){
			$return = $return.'</fieldset>';
			}
			return $return_f.$return;
		}
		
	}
?>