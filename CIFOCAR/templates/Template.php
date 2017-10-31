<?php
class Template{
    
    //PONE EL HEADER DE LA PAGINA
		public static function header(){	?>
			<header>
				<figure>
					<a href="index.php">
						<img alt="logo Cifocar" title="logo Cifocar" src="images/logos/logo-cifocar.png" />
					</a>
				</figure>
				<hgroup>
					<h2>Compra y Venta de vehículos de segunda mano</h2>
				</hgroup>
			</header>
		<?php }
		
		
		//PONE EL FORMULARIO DE LOGIN
		public static function login(){?>
			<form method="post" id="login" autocomplete="off">
				<input type="text" placeholder="usuario" name="user" required="required" />
				<input type="password" placeholder="clave" name="password" required="required"/>
				<input type="submit" name="login" value="Login" />
			</form>
		<?php }
		
		
		//PONE LA INFO DEL USUARIO IDENTIFICADO Y EL FORMULARIOD E LOGOUT
		public static function logout($usuario){	?>
			<div id="logout">
				<span>
					Hola 
					<a href="index.php?controlador=Usuario&operacion=modificacion" title="modificar datos">
						<?php echo $usuario->nombre;?>
					</a><?php if($usuario->admin) echo ', eres administrador';?>
				</span>
								
				<form method="post">
					<input type="submit" name="logout" value="Logout" />
				</form>
			</div>
		<?php }
		
		
		//PONE EL MENU DE LA PAGINA
		public static function menu($usuario){ ?>
			<nav>
				<ul class="menu">
					<li><a href="index.php">Inicio</a></li>
					</ul>
				<?php 
		
				//pone el menu de compras
				if($usuario && $usuario->privilegio==1){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=Vehiculo&operacion=listarvehiculos">Listar Vehiculos</a></li>
					<li><a href="index.php?controlador=Vehiculo&operacion=nuevoVehiculo">Nuevo Vehículo</a></li>
					<li><a href="index.php?controlador=Marca&operacion=nuevaMarca">Nueva Narca</a></li>
					<li><a href="index.php?controlador=Marca&operacion=listarmarcas">Listar Marcas</a></li>
					<li><a href="index.php?controlador=Usuario&operacion=modificarUsuario">Modificar Usuario</a></li>
				</ul>
				<?php } 
				
				//pone el menu de ventas
				if($usuario && $usuario->privilegio==2){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=Vehiculo&operacion=listarvehiculos">Listar Vehiculos</a></li>
				</ul>
				<?php }
				
				//pone el menu del administrador
				if($usuario && $usuario->admin){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=Usuario&operacion=listarusuarios">Listar Usuarios</a></li>
					<li><a href="index.php?controlador=Usuario&operacion=registro">Nuevo Usuario</a></li>
					
				</ul>
				<?php }	?>
				
			</nav>
		<?php }
		
		//PONE EL PIE DE PAGINA
		public static function footer(){	?>
			<footer>
         			<p>IFOCAR concesionario:</p>
         			<a href="#"> <img class="logo" alt="twitter logo" src="images/logos/twitter.png" />
         			<a href="#"> <img class="logo" alt="twitter logo" src="images/logos/facebook.png" />
         			
				</a>
			</footer>
		<?php }
	}
?>