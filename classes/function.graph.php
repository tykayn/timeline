	<?php 
	function barres($tab,$x,$y,$titre='titre',$votes='',$taillemaxbarres = 400,$disposition='h'){
	
		
//		print_r($tab);
//		echo"______";
//			$tab = asort($tab);
//			print_r($tab);
		
		if(!empty($tab)){
		
			
			if($votes==''){
				foreach($tab AS $k=>$v){
				$votes += $v;
				}
				if($votes==''){
					die("0 votes");
				}
			}
			
			$barres ='';
			//gestion de la disposition des barres
			if($disposition == 'h'){
			//horizontal
				foreach($tab AS $k=>$v){
					
					$part= ceil(100*$v/$votes);
					$part= ceil($part*$taillemaxbarres/100);
					$barres .= '<div class="points">'.$k.'</div><div class="barre" style="width:'.$part.'px" ><div class="barre_value_v">'.$v.'</div></div><br/>';
				}					
			
			return '
				<div class="barres_table">
				<h2>'.$titre.'</h2>
				<table>
				
				<tbody>
				<tr>
				<td><h3 class="x_label" >'.$x.'<h3></td>
				<td>'.$barres.'</td>
				</tr>
				
				<tr>
				<td></td>
				<td><h3 class="y_label">'.$y.'<h3></td>
				</tr>
				</tbody>
				
				</table>
				</div>
				';

			}
			elseif($disposition == 'v'){
			//vertical
				foreach($tab AS $k=>$v){
					
					$part= ceil(100*$v/$votes);
					$part= ceil($part*$taillemaxbarres/100);
					$barres .= '
					<div class="bloc_v">
						<div class="barre_v" style="height:'.$part.'px" >
							<div class="barre_value">'.$v.'</div>
						</div>
						<div class="points_v">'.$k.'</div>
					</div>
					';
				}	

				return '
				<div class="barres_table">
				<h2>'.$titre.'</h2>
				<table>
				
				<tbody>
				<tr>
				<td><h3 class="y_label_v">'.$y.'<h3></td>
				<td>'.$barres.'</td>
				</tr>
				
				<tr>
				<td></td>
				<td><h3 class="x_label_v">'.$x.'<h3></td>
				</tr>
				</tbody>
				
				</table>
				</div>
				';
			}
			
	}
	else{
		return '<h2> Le sondage n\'a pas encore de votes, soyez la première personne à participer! *0* </h2>';
		
	}
	
}

?>