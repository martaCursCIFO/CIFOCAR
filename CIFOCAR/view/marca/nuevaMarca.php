<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Nueva Marca <?php echo $vehiculo->marca;?></title>
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
			<h2>Nueva Marca</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<label>Marca:</label>
				<input type="text" name="marca" required="required"/><br/>

				
				<input type="submit" name="guardar" value="Guardar"/>
				<input type="button" name="cancelar" value="Cancelar" onclick="history.back();"/><br/>
			</form>
			
			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>