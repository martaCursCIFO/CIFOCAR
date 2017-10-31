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
		
		<section id="content">
			
			<h2>Detalles del Vehiculo <?php echo $vehiculo->modelo;?></h2>
			
			<div class="contenedor">
    			<article class="texto">
 
        			<h3>Marca</h3>
					<p><?php echo $vehiculo->marca;?></p>
        			
        			<h3>Matricula</h3>
					<p><?php echo $vehiculo->matricula;?></p>
        			
        			
        			<h3>Año Matriculacion</h3>
        			<p><?php echo $vehiculo->any_matriculacion;?></p>
        			
        			<h3>Kilometros</h3>
        			<p><?php echo $vehiculo->kms;?></p>
        			
           			<h3>Caballos</h3>
        			<p><?php echo $vehiculo->caballos;?></p>

           			<h3>Detalles</h3>
        			<p><?php echo $vehiculo->detalles;?></p>
        			        			
          			<h3>Vendedor</h3>
        			<p><?php echo $vehiculo->vendedor;?></p>

          			<h3>Estado</h3>
        			<p><?php echo $vehiculo->estado;?></p>
        			
        			<h3>Fecha Venta</h3>
        			<p><?php echo $vehiculo->fecha_venta;?></p>
        		</article>
        		
        		<figure class="imagen">
        			<?php 
        			echo "<img src='$vehiculo->imagen' alt='Imagen de $vehiculo->marca' title='Imagen de $vehiculo->marca'/>";
        			echo "<figcaption>$vehiculo->modelo</figcaption>";
        			?>
        		</figure>	
    		</div>	
    		
    		<p class="volver" onclick="history.back();">Atrás</p>
    		
		</section>
		
		<?php Template::footer();?>
    </body>
</html>