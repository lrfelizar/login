<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usuarios</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> 
	<link rel="stylesheet" href="css/estilos.css">
	<script defer src="fontawesome/all.js"></script>
</head>
<body>
	<div class="contenedor">
		<header>
			<h1>Usuarios</h1>
			<a href="cerrar.php">Cerrar Sesión</a>
			<div>
				<button id="btn_cargar_usuarios" class="btn active">Cargar Usuarios</button>
			</div>
		</header>
		<main>
			<div class="error_box" id="error_box">
				<p>Se ha producido un error.</p>
			</div>
			<div class="loader" id="loader"></div>
			<div id="principal">
				<form action="" method="" id="formulario" class="formulario">
					<input type="text" name="nombre" id="nombre" placeholder="Nombre">
					<input type="text" name="edad" id="edad" placeholder="Edad">
					<input type="text" name="pais" id="pais" placeholder="Pais">
					<input type="email" name="correo" id="correo" placeholder="Correo">
					<button type="submit" class="btn">Agregar</button>
				</form>
				<table id="tabla" class="tabla">
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Edad</th>
						<th>Pais</th>
						<th>Correo</th>
						<th>Acciones</th>
					</tr>
				</table>
			</div>
			
			<div id="modificar" hidden>
				<form action="" method="" id="formulario_m" class="formulario">
					<input type="text" name="id" id="id" hidden readonly>
					<input type="text" name="nombre_m" id="nombre_m" data-toggle="tooltip" title="Nombre">
					<input type="text" name="edad_m" id="edad_m" data-toggle="tooltip" title="Edad">
					<input type="text" name="pais_m" id="pais_m" data-toggle="tooltip" title="País">
					<input type="email" name="correo_m" id="correo_m" data-toggle="tooltip" title="Correo">
					<button id="modificar_us" class="btn active">Modificar</button>
				</form>
			</div>
		</main>
	</div>
	<script src="js/main.js"></script>
</body>
</html>