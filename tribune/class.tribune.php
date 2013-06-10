<?php

class tribune{
	var $pdo;
	var $debug;
	var $infos;
	var $display;
	var $i=-1;
	
	/**
	 *	Affiche un message pour débuguer
	 * @param type $message 
	 */
	public function info($message){
	if($this->debug == 1){
		$this->i++;
$this->infos .= "<span class='tktr_info'>$this->i $message </span>";

	}

	}
	public function getip(){
		return $_SERVER['REMOTE_ADDR'];
	}
	public function save(){
	
			$this->info("hop ça sauvegarde");
			 foreach($_POST as $k => $v) { 
				 $_POST[$k] = mysql_escape_string($v) ;
				}  
		 
			$this->info(print_r($_POST,true));
			$save_vars = 'enregistré: '.$_POST['id_tribune']."', '".$_POST['pseudo']."', '".$_POST['message']."', '".$_POST['email']."', '".$_POST['url']."', NOW() , '".$this->getip().'';
			$this->init_pdo();
			
		//	echo"$save_vars";
			$this->info($save_vars);
		try{	
			$this->pdo->exec("INSERT INTO `tykayn`.`tk_tribune` 
			(`id`, `id_tribune`, `pseudo`, `message`, `mail`, `url`, `datetime`, `ip`, `class`)
			VALUES
			('', '".$_POST['id_tribune']."', '".$_POST['pseudo']."', '".$_POST['message']."', '".$_POST['email']."', '".$_POST['url']."', NOW() , '".$this->getip()."', 'show')
			");
						
			$this->info("enregistrement ok");
			}
		catch(PDOException $e){
						
			$this->info("FAIL d'enregistrement".print_r($e,true));
			}

	}
	
	public function __construct() {
		$this->setdebug(1);
		$this->info("tribune lancée");
		//tester la présence d'un fichier de config
		if(!file_exists("admin.conf")){
			$this->setup();
		}
		else{
			$this->info( " fichier de config existant.");
		
			if (!$adminfile = fopen("admin.conf","r")) {
			$this->display( "Echec de l'ouverture du fichier");
			exit;

			}
		
		$this->info("détection de commentaire envoyé");
		if(isset($_GET['tribune']) && $_GET['tribune']=='post'){
		$this->info(print_r($_POST,true));
			$this->save();
			$this->info("Merci pour le commentaire!");
			
		}
			//test de connexion a la bdd selon les données du fichier de config
			
		$this->info("la tribune est prête à être utilisée.");
		}
	}
	/*
	 * montre le formulaire d'install si nécessaire
	 * 
	 */
	public function setup(){
		
		if(isset($_GET['setup']) && $_GET['setup']=='ok'){
			

			$this->bdd($_POST['server'],$_POST['bdd'],$_POST['bdd_user'],$_POST['bdd_pass']);
				// bdd($server,$bdd,$user,$pass)
			$this->info("Cryptage des mots de passe et enregistrement de la configuration.");	
			$_POST['pass_admin'] = md5($_POST['pass_admin']);
			
		//	print_r($_POST);
			
			
			$adminfile=	fopen('admin.conf', 'a');
		if(	fwrite($adminfile , serialize($_POST))	){
			$this->info("enregistement du fichier de config réussi");
			}
			else{
		$this->info("échec de l'enregistrement du fichier de config");
			}
		
			
		}
		else{ //formulaire pour s'inscrire
			$this->display .=("
			<div id='tktr_setup'>
				<h1>TK Tribune - installation</h1>
				<span class='tktr_info'>
				Remplissez ces champs pour l'installation. Vous devez disposer d'une base de données.
				</span>
				<form method=post action='?setup=ok'>
				<fieldset><ul type='disc'>
					<li><label>Pseudo de l'admininistrateur</label> <input type='text' name='pseudo_admin' value='admin_tribune' required/></li>
					<li><label>mot de passe</label> <input type='password' name='pass_admin' value='' required/></li>
					</ul>
					</fieldset>

					<fieldset>
					<ul type='disc'>
					<li><label>Nom du serveur </label><input type='text' name='server' value='localhost' required/></li>
					<li><label>Nom de la base de données </label><input type='text' name='bdd' value='' required/></li>
					<li><label>utilisateur de la BDD</label> <input type='text' name='bdd_user' value='' required/></li>
					<li><label>mot de passe</label><input type='password' name='bdd_pass' value='' required/></li>
					</ul>
					<input type='hidden' name='ok' value='yay' />
				</fieldset>
				
			<input type='submit' value='envoyer' />
			</form>
			</div>
			");
		}
		
	}
	
	/*
	 * crée la table tk_tribune
	 */
	public function bdd($server,$bdd,$user,$pass){
		
					$this->display.="<span class='tktr_info'>Création de la table </span>";
					$this->init_pdo($server, $bdd, $user, $pass);
					//test si la table existe	
					$this->pdo->exec("
						SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
					SET time_zone = '+00:00';

					--
					-- Structure de la table `tk_tribune`
					--

					
					CREATE TABLE IF NOT EXISTS `tk_tribune` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `id_tribune` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
					  `pseudo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
					  `message` text COLLATE utf8_unicode_ci NOT NULL,
					  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					  `datetime` datetime NOT NULL,
					  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
					  `class` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
					");
					$this->display.="<span class='tktr_info'> La table a été bien installée! </span>
						Vous pouvez commencer à installer vos formulaires de commentaires et
						afficher les listes sur vos pages, ou encore gérer le panneau d'administration.
						Lisez la page d'aide de la TK Tribune sur <a href='http://artlemoine.com' >le site de l'auteur, artlemoine.com </a>";
					$this->info(" table tk_tribune ok");
					//comparer avec le fichier de config
		
	}
	public function init_pdo(){
		
if (!$adminfile = fopen("admin.conf","r")) {
			$this->display( "Echec de l'ouverture du fichier");
			exit;
			}

			$config = unserialize(fread($adminfile , filesize('admin.conf')));
		// print_r($config);
			$server = $config['server'];
			$bdd = $config['bdd'];
			$user = $config['bdd_user'];
			$pass = $config['bdd_pass'];
$dsn = 'mysql:dbname='.$user.' ;host='.$server;
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
try {
    $this->pdo = new PDO('mysql:host=localhost;dbname=tykayn', $user,$pass,$pdo_options);
	// On ajoute une entrée dans la table jeux_video
    
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
}
	/*
	 * choisir d'activer ou non le mode debug affichant les commentaires
	 */
	public function setdebug($status){
		$this->debug = $status;
	}

	public function comform($id_tribune){
		$this->display.="
			<div class='tktr_comform' id='tktr_add_comm".$id_tribune."'>
				<form action='index.php?tribune=post' method='POST'>
				<fieldset>
				<label for='pseudo'>Pseudo :</label> <input type='text' name='pseudo' placeholder='votre pseudo' required/>
				<label>e-mail :</label> <input type='email' name='email' placeholder='votre email' required/>
				<label>site web :</label><input type='url' name='url' placeholder='www.monsite.com' />
				<label>message :</label><textarea name='message' placeholder='dis moi tout grand fou.' required></textarea>
					<input type='hidden' name='id_tribune' value='".$id_tribune."' />
				</fieldset>
				
			<input type='submit' value='envoyer' />
			</form>
			</div>
";
	}
	
	
	/**
	 *	afficher la liste des commentaires
	 * @param type $id_tribune 
	 */
	public function com_list($id_tribune){
		$this->info .="commentaires de la tribune $id_tribune";
		$this->init_pdo();
	

		$query = $this->pdo->query("SELECT * from tk_tribune where id_tribune = '$id_tribune' AND class = 'show' ORDER BY datetime DESC") ;
		//		print_r($query);
		$nb_coms = $query->rowCount();
		if($query->rowCount()==0){
			$this->display .= '<span class="tktr_nocom"> pas encore de commentaires. Réagissez!</span>';
			$this->comform($id_tribune);
		}
		else{	
			$this->comform($id_tribune);
			$this->display .= "<span class='tktr_com_nb'>$nb_coms Commentaires</span>";
			foreach  ( $query as $row) {
				$row['message'] = nl2br($row['message']);
			$this->display .= "<div class='tktr_com'>
					
				<a href='$row[url]'><span class='tktr_com_pseudo'>$row[pseudo]  </span></a>
				<span class='tktr_com_date'>	$row[datetime] </span>
				<span class='tktr_com_msg'>	$row[message]</span>

					</div>" ;
				  }
		$this->display .= "<a href='#tktr_add_comm".$id_tribune."'><span class='tktr_com_foot'> Vous aussi participez!</span></a>";

		 }
		
		//si y'en a pas
	}
/**
 * afficher l'interface admin
 */
public function admin() {
	 
	 //vérifier l'identification ?tribune=auth
	 $this->display .="<a href='?tribune=auth'>Identification admin</a>";
	 if(isset($_SESSION['tktr_admin']) && $_SESSION['tktr_admin'] == 'ok' && isset($_GET['tribune']) && $_GET['tribune']=="auth"){
		 $this->showadmin();
	 }
	 elseif(isset($_GET['tribune']) && $_GET['tribune']=="auth"){
		 $_POST['psswd'] = md5($_POST['psswd']);
		  $this->info("<h2>identification...</h2> $_POST[pseudo_admin] $_POST[psswd]");
		 //comparer avec le fichier de config
		  if (!$adminfile = fopen("admin.conf","r")) {
			$this->display( "Echec de l'ouverture du fichier");
			exit;
			}

			$config = unserialize(fread($adminfile , filesize('admin.conf')));
		// print_r($config);
		 $this->info("$_POST[pseudo_admin] <br/> $config[pseudo_admin] <br/> $_POST[psswd] <br/> $config[pass_admin]");
			if( $_POST['pseudo_admin'] == $config['pseudo_admin'] && $_POST['psswd'] == $config['pass_admin']){
				
			 $this->info("<h2>correcte</h2>");	
			 $_SESSION['tktr_pseudo'] = $_POST['pseudo_admin'];
			 $_SESSION['tktr_psswd'] = $_POST['psswd'];
			 $_SESSION['tktr_admin'] = 'ok';
			 
			 $this->display .="youpi yay";
			  $this->showadmin();
			}
			else{
				
				 $this->display .="<h1>Administration des tribunes</h1>
					 identifiant ou mot de passe erronés. Et ouais.
					  <form method=post action='?tribune=auth'>
				<fieldset>
				<label>Pseudo de l'admininistrateur</label>
				<input type='text' name='pseudo_admin' value='' required/>
				<label>mot de passe</label><input type='password' name='psswd' value='' required/>
					<input type='submit'  value='authentifier' />
				</fieldset>
			</form>";
			}
	 }
	 // !isset($_SESSION['tktr'])
//	  else{
//		  $this->display .="<a href='?tribune=auth'><h2>Identifiez vous donc</h2></a>
//			  <form method=post action='?tribune=auth'>
//				<fieldset>
//				<label>Pseudo de l'admininistrateur</label>
//				<input type='text' name='pseudo_admin' value='' required/>
//				<label>mot de passe</label><input type='password' name='psswd' value='' required/>
//					<input type='submit'  value='authentifier' />
//				</fieldset>
//			</form>
//			  ";
//	 }
	
	}
	
	public function showadmin() {
	$this->display .="Bienvenue $_SESSION[tktr_pseudo] tralalalahihou. <a href='?'>log out</a>";
	//lister les commentaires pour choisir lesquels cacher
	$this->init_pdo();
	$query = $this->pdo->query("select * from tk_tribune ORDER BY datetime desc");
	foreach  ( $query as $row) {
				$row['message'] = nl2br($row['message']);
			$this->display .= "<div class='tktr_com spoil $row[class]'>
				<input type='checkbox' name='$row[id]' value='ON' />
					$row[datetime]
				<strong>	$row[pseudo] </strong>
					
						<div>
						Tribune $row[id_tribune]
					<a href=$row[url] >$row[url]</a>
						$row[mail]
						$row[ip]
						</div>
					</div>" ;
				  }
				  $this->display .= "cacher les commentaires sélectionnés";
				  
	}
	public function __destruct() {
		$this->info('Infos de debug');
	echo $this->infos.$this->display;
	}
	
	
}
?>