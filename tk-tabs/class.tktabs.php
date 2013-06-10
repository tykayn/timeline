<?php

/**
 * Merci de faire un lien vers mon site si cette classe vous a été utile :)
 * TKtabs fait un menu à onglets en associant un nom à une page grâce à
 * un array('nom onglet'=>'lien') et pour chaque onglet
 * une détection de l'onglet actif selon $_REQUEST['p'].
 * Important: des tableaux simples avec des entrées associatives sont possibles. Les parties simples lieront vers une page du même nom.
 * Advice: Think to set a css style for
 * nav .tab, .active and .not_active tabs.
 * @author TyKayn
 * @filesource http://artlemoine.com
 * @link http://artlemoine.com/medias/apps/tk-tabs/
 */
class tab {
/**
 * Fournir un tableau liant un nom d'onglet a une adresse à lier pour faire un menu de navigation.
 * par exemple new tab($array) où $array = array('nom onglet'=>'lien') pour faire un menu de navigation.
 */
	//tableau nom => page
	public $retour;
	public $url_var="p";
	
	/**
	 *	Définir la variable à tester dans l'url. Vaut "p" (pour page) par défaut.
	 * @param type $var 
	 */
	public function set_url_var($var){
	$this->$url_var =$var;
	}
	
	public function maketab($array){
		
		
		str_replace('_', '', $array);
		
		$this->retour ='';
		
		//début de la tab
		$this->retour .="	<!--
TkTabs are powered by Baptiste Lemoine : http://artlemoine.com
--><nav class='tabs'>";
		$i=0;
		foreach($array AS $k => $v){
			str_replace("'", "", $v);
			
			if(is_numeric($k)){
				$k = $v ;
			}
			if(isset($_REQUEST[$this->url_var]) && $_REQUEST[$this->url_var]==$v){
				$activity = "active";
			}
			else{
				$activity = "not_active";
			}
			
			//url relative
			$prelink = '?'.$this->url_var.'=';
			//pour url absolue
			
		if(strrchr('http://', $v) ){
			$prelink ="";	
		}
		else{
			$prelink = '?'.$this->url_var.'=';
		}
			
			$this->retour .='	<div class="tab">
									<a href="'.$prelink.$v.'" title="'.$v.'" class="'.$activity.'">
									'.$k.'
									</a>
								</div>';
		}
		
		$this->retour .="	</nav>";
		return $this->retour;
	}


}
?>
