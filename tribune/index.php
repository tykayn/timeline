	<?php 
	session_start();
	?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>	tribune	</title>
	<link rel="shortcut icon" type="image/png" href="favicon.png" />
	<link href="design.css" title="design de jour" type="text/css" media="screen" rel="stylesheet">
    </head>
    <body>
		
		
		<div class="top"></div>
		<div class="nav"></div>
		<div class="main">
		<?php
		include('class.tribune.php');
		$tribune = new tribune();
	//	$tribune->setdebug(1);
	//	$tribune->comform('web');
		$tribune->admin();
		$tribune->com_list('web');
		
		?>
			
			<div class="">
				
			</div>
		</div>


		<div class="foot">
			<a href="http://artlemoine.com" >site de l'auteur</a>
		</div>

    </body>
</html>