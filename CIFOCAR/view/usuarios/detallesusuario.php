<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Detalles del Usuario <?php echo $usuario->user;?></title>
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
			
			<h2>Detalles del Usuario <?php echo $usuarioM->user;?></h2>
			
			<div class="contenedor">
    			<article class="texto">
 
        			<h3>Nombre</h3>
					<p><?php echo $usuarioM->nombre;?></p>
        			
        			
        			<h3>Privilegio</h3>
        			<p><?php echo $usuarioM->privilegio;?></p>
        			
        			<h3>Admin</h3>
        			<p><?php echo $usuarioM->admin;?></p>
        			
           			<h3>Email</h3>
        			<p><?php echo $usuarioM->email;?></p>

           			<h3>Fecha</h3>
        			<p><?php echo $usuarioM->fecha;?></p>
        			        			
          			<h3>Imagen</h3>
        			<p><?php echo $usuarioM->imagen;?></p>

        			<h3>Fecha Alta</h3>
        			<p><?php echo $usuarioM->fecha;?></p>
        		</article>
        		
        		<figure class="imagen">
        			<?php 
        			echo "<img src='$usuario->imagen' alt='Imagen de $usuario->imagen' title='Imagen de $usuarioM->user'/>";
        			echo "<figcaption>$usuarioM->user</figcaption>";
        			?>
        		</figure>	
    		</div>	
    		
    		<p class="volver" onclick="history.back();">Atrás</p>
    		
		</section>
		
		<?php Template::footer();?>
    </body>
</html>