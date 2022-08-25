<?php
include("./administrador/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SISTitulos DREP</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="icon" type="image/x-icon" href="./logos/logogrdrep.png">
	<link rel="stylesheet" href="jscss/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="jscss/bootstrap/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="./css/estilloConsulta.css">
	<script src="jscss/jquery.js"></script>
	<script src="jscss/bootstrap/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="./css/ionicons.min.css">
	<link rel="stylesheet" href="./css/stilo.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body >
	<header class="header-principal container">
		<div class="row">
			<div class="col-sm-12 logo1">
				<a href="https://www.drepuno.gob.pe/" target="_blank"><img class="img-responsivo" src="./logos/logogrdrep.png" /></a>
				<a href="https://www.drepuno.gob.pe/" target="_blank"><img class="img-responsivo logotwo" src="./logos/logochacana.png" /></a>
			</div>
		</div>
	</header>
	<div class="well well-lg contenedor1">
		<div class="container titulos">
			<h2 class="subtitulo">Dirección Regional de Educación Puno</h2>
			<h1 class="titulo">Consulta de títulos de instituciones tecnológicas y pedagógicas</h1>
		</div>
	</div>
	<div class="well container contenedor formConsulta" id="bajar">
		<form class="" action="index.php">
			<div class="consultaTitulos  ">
				<label  >DNI :</label>
				<input type="number" class="form-control" id="inputPassword2" placeholder="Ingrese su DNI" name="dni"  required>
				<div class="g-recaptcha captcha"  data-sitekey="6LdjtfogAAAAAGn2lsCKep4ab_ly7j3UWhNmBxwk" ></div>
			</div>
			<div class="botones" >
				<a href="#bajar" id="baja"></a>
				<button type="submit" name="consultar" class="btn btn-info btn-lg" ><span class="glyphicon glyphicon-search"></span> Consultar</button>
				<a href="./" class="btn btn-danger btn-lg " ><span class="glyphicon glyphicon-retweet"></span> Reiniciar</a>
			</div>
		</form>
	</div>
	<div class="container">
		<?php
		if (isset($_GET['consultar'])) {
			echo "<script type='text/javascript'>
			document.getElementById('baja').click()
			</script>";
			$dni=$_GET['dni'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$captcha = $_GET['g-recaptcha-response'];
			$sql = "SELECT * FROM consulta_titulados WHERE dni=$dni";
			$secretkey="6LdjtfogAAAAAKqchbKdw0upPffmzpfTHXf41anu";
			$respuesta= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
			$atributos = json_decode($respuesta, TRUE);
			if($atributos['success']==true){
				echo "<br>";
				if (!$resultado = $conn->query($sql)) die("Error en la consulta");
				echo "<table class='table table-hover table-bordered'>";
				echo "<thead class='tabla'>";
				echo "<tr >";
				echo "<th class='th1'>GRADUADO</th>";
				echo "<th class='th2'>GRADO O TITULO</th>";
				echo "<th class='th3'>INSTITUCION</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody >";
				while($reg = $resultado->fetch_assoc()){
					if($reg['dni']==$dni){
						echo "<tr class='tablaTbody'>";
						echo "<td class='th1 text-uppercase'>".$reg['apellidos']." ".$reg['nombre']."<br>"."DNI: ".$reg['dni']."</td>";
						echo "<td class='th2 text-uppercase'>".$reg['nom_titulo']."<br> Fecha del Titulo: ".$reg['fecha']."<br> Tipo de Institucion: ".$reg['instituto']."</td>";
						echo "<td class='th3 text-uppercase'>".$reg['nombre_inst']."<br>".$reg['lugar']."</td>";
						echo "</tr>";
					}}
					echo "</tbody>";
					echo "</table>";
				}else{
					echo "<div class='alert alert-danger alerta' role='alert'>Verifique el CAPTCHA</div>";
				}
			}
			echo "</br>";
			echo "</br>";
			?>
			<footer class="footer-07 well">
				<div class="row justify-content-center">
					<div class="col-md-12 text-center">
						<h2 class="footer-heading " style="text-align: center ;"><a href="https://www.drepuno.gob.pe/" target="_blank" class="logo">Dirección Regional de Educación Puno</a></h2>
						<ul class="ftco-footer-social p-0">
							<li class="ftco-animate"><a href="https://twitter.com/drepuno" data-toggle="tooltip" data-placement="top" target="_blank" title="Twitter"><span class="bi bi-twitter"></span></a></li>
							<li class="ftco-animate"><a href="https://www.facebook.com/DREPuno" data-toggle="tooltip" data-placement="top" target="_blank" title="Facebook"><span class="bi bi-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="bi bi-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="row mt-5 " >
					<div class="col-md-12 text-center">
						<p class="menu">
							<b> Dirección:</b> Jr. Bustamante Dueñas 881 - Urb II Etapa Chanu Chanu - Puno <br/><b>Teléfono:</b> (51) 366170 - 357005 | <b>E-Mail:</b> yachay@drepuno.gob.pe
						</p>
						<p class="copyright">
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> >Todo los derechos reservados | Direccion Regional de Educación Puno - Oficina de Informática
						</p>
					</div>
				</div>
			</footer>
		</div>
	</body>
</div>
</html>
