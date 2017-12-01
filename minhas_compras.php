<?php
include "cabecalho.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Minhas Compras</title>
	<style type="text/css">
		#foto{
			width: 220px;
			float: left;
			margin: 5px;
		}
	</style>
</head>
<body>
	<?php
	$larguras = [0,5,54,100];

	session_start();
	$dbname = "id2846308_projeto1";
	$usuario = "id2846308_pep1";
	$senha = "@lunoifpe";

	try{
		$conn = new PDO("mysql:host=localhost;dbname=$dbname",$usuario,$senha);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Falha na conexão: ";$e.getMessage();
	}
	$id = $_SESSION['id'];
	
	echo "<h1>Produtos Comprados</h1>";
	$sql = "SELECT p.PRO_TITULO, p.PRO_PRECO, p.PRO_USER_ID, c.COM_VENDEDOR, c.COM_COMPRADOR, c.COM_ID FROM produtos as p inner join compra as c on c.COM_COMPRADOR = p.PRO_USER_ID WHERE COM_COMPRADOR = '$id'";

	foreach ($conn->query($sql) as $row){
		$titulo = $row['PRO_TITULO'];
		$compraid = $row['COM_ID'];
		$status = $row['COM_STATUS'];
		$foto = $row['PRO_ARQUIVO'];
		echo "<h2>$titulo</h2>
		<img src='.".$foto."' id='foto'>

		<div class='container'>
			<div class='row'>
				<div class='col-md-1 col-sm-1'>
					<i class='fa fa-money fa-3x' aria-hidden='true'></i>
		 		</div>
		 		<div class='col-md-1 col-md-offset-5 col-sm-1 col-sm-offset-5'>
		 			<i class='fa fa-truck fa-3x' aria-hidden='true'></i>
		 		</div>
		 		<div class='col-md-1 col-md-offset-4 col-sm-1 col-sm-offset-4'>
					<i class='fa fa-check fa-3x' style='color:green' aria-hidden='true'></i>
				</div>
			 </div>
			 <div class='row'>
			 	<div class='col-md-12 col-sm-12'>
					<div class='progress'>

					<div class='progress-bar progress-bar-success' style='width: $larguras[$status]%'>
					    <span class='sr-only'>35% Complete (success)</span>
					  </div>
					</div>
				</div>
			</div>
		</div>";

	}


	?>

</body>
</html>