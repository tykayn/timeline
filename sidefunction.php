<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * objet à étendre pour la toolbox
 */
class tool{
    public $debug="<div class='debug'><h1>Debug</h1>";
    public function log($text){
        
        $this->debug .= "<hr/>".var_dump($text);
    }
    function _destruct(){
        $this->debug .= "</div><a href='http://artlemoine.com'>-by tykayn<a/>";
    }
}
/**
 * Créer un tableau pour remplir la timeline via un formulaire html
 *
 * @author TyKayn
 */
class timeform {
    // TODO pouvoir afficher un bloc d'édition de tableau, ajout de nouvelle ligne en js
   public $html = '<fieldset>
  	<legend>Remplissez les champs suivants</legend>
		<form method="get" action="test.php">
        
		<input type=submit value="envoyer la purée">
		<input type=hidden name="friseform" value="yay" />
		<input type=date name="un" placeholder="date" required value=""/><button class="add_end">+fin</button>
		<input type=text name="un_t" placeholder="description" value=""/><button class"remove">X</button><br/>
		<button class="add_line">+1 évènement</button>
		</form>
		</fieldset>';
    // timeline avec skin au choix en js
}

?>
