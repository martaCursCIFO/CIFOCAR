<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Receta nueva</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			<h2>Receta</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				<label>Nombre:</label>
				<input type="text" name="nombre" required="required" /><br/>
				
				<label>Descripción:</label>
				<textarea name="descripcion"></textarea><br/>
				
				<label>Ingredientes:</label>
				<input type="text" name="ingredientes" /><br/>
				
				<label>Dificultad:</label>
				<select name="dificultad">
					<option value="alta">Alta</option>
					<option value="media">Media</option>
					<option value="baja">Baja</option>
				</select><br/>
				
				<label>Tiempo:</label>
				<input type="number" name="tiempo" /><br/>
				
				<label>Imagen:</label>
				<input type="file" name="imagen" accept="image/*" required=”required” /><br>
				
				
				<label></label>
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>