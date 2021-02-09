<?php
	if(!empty($_POST['seller_id']))
	{
		$data = json_decode( file_get_contents("https://api.mercadolibre.com/sites/MLA/search?seller_id=179571326#json"), true);
		$result = '';

		for ($i=0; $i < count($data['results']); $i++)
		{ 
			$file = fopen($data['seller']['id']. ".log", "w");
			$result .= $data['results'][$i]['id'].' - '.$data['results'][$i]['title'].' - '.$data['results'][$i]['category_id'].' - '.$data['results'][$i]['domain_id']."\n";

			fwrite($file, $result);
			fclose($file);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Test Gestión Operativa</title>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<?php
				if(isset($data))
					if(file_exists($data['seller']['id']. ".log"))
						echo '<div class="alert alert-success">Se ha generado con éxito el log.</div>';
			?>
			<div class="col-md-4 offset-md-4 mt-5">
			<form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
				<input class="form-control" type="text" name="seller_id" placeholder="Inserte el seller_id del usuario">
				<button class="btn btn-success mt-2 float-right">Buscar</button>
			</form>
		</div>
	</body>
</html>