<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
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
			<h2>Formulario de registro</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
			
				<label>User:</label>
				<input type="text" id="user" name="user" required="required" 
					pattern="^[a-zA-Z]\w{2,9}" title="3 a 10 caracteres (numeros, letras o guión bajo), comenzando por letra"/>
					<span id="registrado" class="error"></span><br/>
					
				<script>
                	//cuando cargue el documento
                	$(document).ready(function(){
                                
                    //cuando cambien el usuario…
                    $('#user').change(function(){

                        //crea el objeto con los datos a pasar al script PHP
                      	var datos = {'user': $(this).val()};
                
                      	//invoca el script PHP y muestra el resultado en el span con id="registrado"
                      	$('#registrado').load('index.php?controlador=Usuario&operacion=comprobar', datos);
                    });
                });
                </script> 
				
				<label>Password:</label>
				<input type="password" name="password" required="required" 
					pattern=".{4,16}" title="4 a 16 caracteres"/><br/>
				
				<label>Nombre:</label>
				<input type="text" name="nombre" required="required"/><br/>
				
				<label>Privilegio:</label>
				<input type="number" name="privilegio" required="required"/><br/>
				
				<label>admin:</label>
				<input type="number" name="admin" required="required"  patern="0\1\2" /><br/>
				
				<label>Email:</label>
				<input type="email" name="email" required="required"/><br/>
				
				<label>Imagen:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
				<input type="file" accept="image/*" name="imagen" />
				<span>max <?php echo intval($max_image_size/1024);?>kb</span><br />
				
				<label></label>
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>