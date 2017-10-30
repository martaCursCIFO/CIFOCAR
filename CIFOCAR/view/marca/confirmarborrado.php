<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Confirmar borrado</title>
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
			<h2>Confirmar borrado de <?php echo $marca;?></h2>
			
			
            
            <form method="POST">
                <label>Estas seguro?</label>
                <input type="submit" name="confirmarborrado" value="Confirmar" />
                <input type="button" onclick="history.back();" value="Cancelar"/>
            </form>
			
			
		</section>
		
		<?php Template::footer();?>
    </body>   
</html>