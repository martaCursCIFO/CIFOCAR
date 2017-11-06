<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Nuevo Vehiculo</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
		<script src="js/jquery.js"></script>
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			<h2>Nuevo Vehículo</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
			
				<label>Marca:</label>
				<select name="marca">
					<?php 
					foreach ($marcas as $marca){
					    echo '<option value="'.$marca->marca.'">'.$marca->marca.'</option>';
					}
					?>
				</select><br/>
				
				<label>Modelo:</label>
				<input type="text" name="modelo" required="required" /><br/>
				
				<label>Matricula:</label>
				<input type="text" id="matricula" name="matricula" required="required" />
				<span id="registroMatricula" class="error"></span><br/>
				<script>
                	//cuando cargue el documento
                	$(document).ready(function(){
                                
                    //cuando introduzca la matricula…
                    $('#matricula').change(function(){

                        //crea el objeto con los datos a pasar al script PHP
                      	var datos = {'matricula': $(this).val()};
                
                      	//invoca el script PHP y muestra el resultado en el span con id="registroMatricula"
                      	$('#registroMatricula').load('index.php?controlador=Vehiculo&operacion=comprobar', datos);
                    });
                });
                </script> 
				
				<label>Kilómetros:</label>
				<input type="number" name="kms" required="required" /><br/>
				
				<label>Año de matriculación:</label>
				<input type="number" name="any_matriculacion" required="required" /><br/>
				
				<label>Caballos:</label>
				<input type="number" name="caballos" required="required" /><br/>
				
				<label>Color:</label>
				<input type="text" name="color" required="required" /><br/>
				
				<label>Precio Venta:</label>
				<input type="number" name="precio_venta" required="required" /><br/>
				
				<label>Precio Compra:</label>
				<input type="number" name="precio_compra" required="required" /><br/>
				
				<label>Estado:</label>
				<select name="estado"  disabled='disabled'>
					<option value="0" selected="selected">en venta</option>
					<option value="1">reservado</option>
					<option value="2" >vendido</option>
					<option value="3">devolución</option>
					<option value="4">baja</option>
				</select><br/>
				
				<label>Detalles:</label>
				<textarea name="detalles"></textarea><br/>
				
				<label>Imagen:</label>
				<input type="file" name="imagen" accept="image/*" required=”required” /><br>
				
				
				<label></label>
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>