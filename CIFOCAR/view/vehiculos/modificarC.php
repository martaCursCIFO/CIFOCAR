<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Detalles del Vehiculo <?php echo $vehiculo->marca;?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
			<h2>Formulario de modificación de datos Vehiculos Comprador</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<figure>
					<img class="imagenactual" src="<?php echo $vehiculo->imagen;?>" 
						alt="<?php echo  $vehiculo->matricula;?>" />
				</figure>
				
				
				<label>Marca:</label>
				<input type="text" name="marca" required="required" 
					readonly="readonly" value="<?php echo $vehiculo->marca;?>" /><br/>
				
				<label>Modelo:</label>
				<input type="text" name="modelo" required="required" 
					value="<?php echo $vehiculo->modelo;?>"/><br/>
					
				<label>Matricula:</label>
				<input type="text" name="matricula" required="required" 
					value="<?php echo $vehiculo->matricula;?>"/><br/>
				
				<label>Color:</label>
				<input type="text" name="color" required="required" 
					value="<?php echo $vehiculo->color;?>"/><br/>

				<label>Precio Compra:</label>
				<input type="number" name="precio_compra" required="required" 
					value="<?php echo $vehiculo->precio_compra;?>"/><br/>

				<label>Kilometros:</label>
				<input type="number" name="kms" required="required" 
					value="<?php echo $vehiculo->kms;?>"/><br/>
					
				<label>Caballos:</label>
				<input type="number" name="caballos" required="required" 
					value="<?php echo $vehiculo->caballos;?>"/><br/>

				<label>Año de Matriculacion:</label>
				<input type="number" name="any_matriculacion" required="required" 
					value="<?php echo $vehiculo->any_matriculacion;?>"/><br/>

				<label>Detalles:</label>
				<input type="text" name="detalles" 
					value="<?php echo $vehiculo->detalles;?>"/><br/>
					
				<label>Nueva imagen:</label>
				<input type="file" accept="image/*" name="imagen" /><br/><br/>
			
				<label></label>
				<input type="submit" name="modificar" value="modificar"/><br/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>