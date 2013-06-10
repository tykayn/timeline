<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Double page Url-maker</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Mon design" href="design.css" />
    </head>
    <body>
		<?php
		require('config.php');
		
		$corpsdouble = "
			<iframe src='index.php'>
				</iframe>
			<iframe src='$blognewposturl'>
				</iframe>
			";
			
			echo $corpsdouble;
		?>
    </body>
</html>
