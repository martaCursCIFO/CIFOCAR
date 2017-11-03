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
		
			<h2>Formulario de modificación de datos Vehiculos Vendedor</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<figure>
					<img class="imagenactual" src="<?php echo $vehiculo->imagen;?>" 
						alt="<?php echo  $vehiculo->matricula;?>" />
				</figure>
				
				
				<label>Marca:</label>
				<input type="text" name="marca" disabled
					readonly="readonly" value="<?php echo $vehiculo->marca;?>" /><br/>
				
				<label>Modelo:</label>
				<input type="text" name="modelo" disabled 
					value="<?php echo $vehiculo->modelo;?>"/><br/>
					
				<label>Matricula:</label>
				<input type="text" name="matricula" disabled
					value="<?php echo $vehiculo->matricula;?>"/><br/>
				
				<label>Color:</label>
				<input type="text" name="color" disabled
					value="<?php echo $vehiculo->color;?>"/><br/>

 				 <label>Precio Venta::</label>
 				 <input type="number" name="precio_venta" required="required"
					 value="<?php echo $vehiculo->precio_venta;?>" /><br/>			

				<label>Precio Compra:</label>
				<input type="number" name="precio_compra" disabled
					value="<?php echo $vehiculo->precio_compra;?>"/><br/>

				<label>Kilometros:</label>
				<input type="number" name="kms" disabled
					value="<?php echo $vehiculo->kms;?>"/><br/>
					
				<label>Caballos:</label>
				<input type="number"  name="caballos"  disabled
					value="<?php echo $vehiculo->caballos;?>"/><br/>

				<label>Fecha de Venta:</label>
				<input type="date" name="fecha_venta"  required="required" 
					value="<?php echo $vehiculo->fecha_venta;?>"/><br/>

				<?php 
				$sel0="";$sel1="";$sel2="";$sel3="";$sel4="";
				    if ($vehiculo->estado==0)
				        $sel0="selected";
			        elseif($vehiculo->estado==1)
			         $sel1="selected";
			        elseif($vehiculo->estado==2)
				        $sel2="selected";
			        elseif($vehiculo->estado==3)
				        $sel3="selected";
			        elseif($vehiculo->estado==4)
				        $sel4="selected";
				        
				?>
				<label>Estado:</label>
				<select name="estado">
					<option value="0"  <?php echo $sel0;?>>en venta</option>
					<option value="1" <?php echo $sel1;?>>reservado</option>
					<option value="2" <?php echo $sel2;?>>vendido</option>
					<option value="3"<?php echo $sel3;?>>devolución</option>
					<option value="4"<?php echo $sel4;?>>baja</option>
				</select><br/>
								
				<label>Año de Matriculacion:</label>
				<input type="number" name="any_matriculacion" disabled
					value="<?php echo $vehiculo->any_matriculacion;?>"/><br/>

				<label>Detalles:</label>
				<input type="text" name="detalles" disabled
					value="<?php echo $vehiculo->detalles;?>"/><br/><br/>
					
				<input type="submit" name="modificar" value="modificar"/><br/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>