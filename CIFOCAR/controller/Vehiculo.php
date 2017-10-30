<?php
	//CONTROLADOR vehiculo 
	class Vehiculo extends Controller{

		//PROCEDIMIENTO PARA GUARDAR UNA NUEVA vehiculo
		public function nueva(){
		    //comprobar si eres administrador
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser ADMIN');

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$this->load_view('view/vehiculos/nueva.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de vehiculo
				$this->load('model/vehiculoModel.php');
				$vehiculo = new vehiculoModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$vehiculo->nombre = $conexion->real_escape_string($_POST['nombre']);
				$vehiculo->descripcion = $conexion->real_escape_string($_POST['descripcion']);
				$vehiculo->ingredientes = $conexion->real_escape_string($_POST['ingredientes']);
				$vehiculo->dificultad = $conexion->real_escape_string($_POST['dificultad']);
				$vehiculo->tiempo = $conexion->real_escape_string($_POST['tiempo']);
			
				//recuperar el fichero
				$fichero = $_FILES['imagen'];
				
				$destino = 'images/vehiculos/';
				$tam_maximo = 1000000; //1MB aprox
				$renombrar = true;
				
				$upload = new Upload($fichero, $destino, $tam_maximo, $renombrar);
				$vehiculo->imagen = $upload->upload_image();
							
				//guardar la vehiculo en BDD
				if(!$vehiculo->guardar()){
				    unlink($vehiculo->imagen);
					throw new Exception('No se pudo guardar la vehiculo');
				}
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de guardado completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		
		//PROCEDIMIENTO PARA LISTAR LOS vehiculos
		public function listarvehiculos($pagina){
		    $this->load('model/VehiculoModel.php');
		    
		    //si me piden APLICAR un filtro
		    if(!empty($_POST['filtrar'])){
		        //recupera el filtro a aplicar
		        $f = new stdClass(); //filtro
		        $f->texto = htmlspecialchars($_POST['texto']);
		        $f->campo = htmlspecialchars($_POST['campo']);
		        $f->campoOrden = htmlspecialchars($_POST['campoOrden']);
		        $f->sentidoOrden = htmlspecialchars($_POST['sentidoOrden']);
		        
		        //guarda el filtro en un var de sesión
		        $_SESSION['filtrovehiculos'] = serialize($f);
		    }
		  
		    //si me piden QUITAR un filtro
		    if(!empty($_POST['quitarFiltro']))
		        unset($_SESSION['filtrovehiculos']);
		    
		    
	        //comprobar si hay filtro
	        $filtro = empty($_SESSION['filtrovehiculos'])? false : unserialize($_SESSION['filtrovehiculos']);
		        
		    //para la paginación
		    $num = 5; //numero de resultados por página
		    $pagina = abs(intval($pagina)); //para evitar cosas raras por url
		    $pagina = empty($pagina)? 1 : $pagina; //página a mostrar
		    $offset = $num*($pagina-1); //offset
		    
		    //si no hay que filtrar los resultados...
		    if(!$filtro){
		      //recupera todas las vehiculos
		      $vehiculos = VehiculoModel::getVehiculos($num, $offset);
		      //total de registros (para paginación)
		      $totalRegistros = VehiculoModel::getTotal();
		    }else{
		      //recupera las vehiculos con el filtro aplicado
		      $vehiculos = VehiculoModel::getVehiculos($num, $offset, $filtro->texto, $filtro->campo, $filtro->campoOrden, $filtro->sentidoOrden);
		      //total de registros (para paginación)
		      $totalRegistros = VehiculoModel::getTotal($filtro->texto, $filtro->campo);
		    }
		    
		    //cargar la vista del listado
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['vehiculos'] = $vehiculos;
		    $datos['filtro'] = $filtro;
		    $datos['paginaActual'] = $pagina;
		    $datos['paginas'] = ceil($totalRegistros/$num); //total de páginas (para paginación)
		    $datos['totalRegistros'] = $totalRegistros;
		    $datos['regPorPagina'] = $num;
		    
		    if(Login::isAdmin())
		      $this->load_view('view/vehiculos/listarvehiculos_admin.php', $datos);
		    else
		      $this->load_view('view/vehiculos/listarvehiculos.php', $datos);
		}
		
		
		
		//PROCEDIMIENTO PARA VER LOS DETALLES DE UN VEHICULO
		public function ver($id=0){
		    //comprobar que llega la ID
		    if(!$id) 
		        throw new Exception('No se ha indicado la ID de la vehiculo');
		    
		    //recuperar la vehiculo con la ID seleccionada
		    $this->load('model/VehiculoModel.php');
		    $vehiculo = VehiculoModel::getVehiculo($id);
		    
		    //comprobar que el vehiculo existe
		    if(!$vehiculo)
		        throw new Exception('No existe la vehiculo con código '.$id);
		    
		    //cargar la vista de detalles
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['vehiculo'] = $vehiculo;
		    $this->load_view('view/vehiculos/detalles.php', $datos);
		}
		
		
		//PROCEDIMIENTO PARA EDITAR UN VEHICULO
		public function editar($id=0){
		    //comprobar que el usuario es admin
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser admin');
		    
		    //comprobar que me llega un id
		    if(!$id)
		        throw new Exception('No se indicó la id de la vehiculo');
		        
		    //recuperar la vehiculo con esa id
		    $this->load('model/vehiculoModel.php');
		    $vehiculo = VehiculoModel::getVehiculo($id);
		    
		    //comprobar que existe la vehiculo
		    if(!$vehiculo)
		        throw new Exception('No existe la vehiculo');   
		    
		    //si no me están enviando el formulario
		    if(empty($_POST['modificar'])){
		      //poner el formulario
		        $datos = array();
		        $datos['usuario'] = Login::getUsuario();
		        $datos['vehiculo'] = $vehiculo;
		        $this->load_view('view/vehiculos/modificar.php', $datos);

		    }else{
		    //en caso contrario
		      $conexion = Database::get();
		      //actualizar los campos de la vehiculo con los datos POST
		      $vehiculo->nombre = $conexion->real_escape_string($_POST['nombre']);
		      $vehiculo->descripcion = $conexion->real_escape_string($_POST['descripcion']);
		      $vehiculo->ingredientes = $conexion->real_escape_string($_POST['ingredientes']);
		      $vehiculo->dificultad = $conexion->real_escape_string($_POST['dificultad']);
		      $vehiculo->tiempo = intval($_POST['tiempo']);
		      
		      //tratamiento de la imagen
		      $fichero = $_FILES['imagen'];
		      
		      //si me indican una nueva imagen
		      if($fichero['error']!=UPLOAD_ERR_NO_FILE){
		          $fotoAntigua = $vehiculo->imagen;
		          
		          //subir la nueva imagen
		          $destino = 'images/vehiculos/';
		          $tam_maximo = 1000000;
		          $renombrar = true;
		          
		          $upload = new Upload($fichero, $destino , $tam_maximo, $renombrar);
		          $vehiculo->imagen = $upload->upload_image();
		          
		          //borrar la antigua
		          unlink($fotoAntigua);
		      }
		      
		      
		      //modificar la vehiculo en la BDD
		      if(!$vehiculo->actualizar())
		          throw new Exception('No se pudo actualizar');
		      
		      //cargar la vista de éxito 
	          $datos = array();
	          $datos['usuario'] = Login::getUsuario();
	          $datos['mensaje'] = "Datos de la vehiculo <a href='index.php?controlador=vehiculo&operacion=ver&parametro=$vehiculo->id'>'$vehiculo->nombre'</a> actualizados correctamente.";
	          $this->load_view('view/exito.php', $datos);
		    }
		}
		
		//PROCEDIMIENTO PARA BORRAR UNA vehiculo
		public function borrar($id=0){
		   //comprobar que el usuario sea admin
		   if(!Login::isAdmin())
		       throw new Exception('Debes ser ADMIN');
		   
	       //comprobar que se ha indicado un id
	       if(!$id)
	           throw new Exception('No se indicó la vehiculo a borrar');
		       
	       //recuperar la vehiculo con esa id
	       $this->load('model/vehiculoModel.php');
	       $vehiculo = VehiculoModel::getvehiculo($id);
	       
	       //comprobar que existe dicha vehiculo
	       if(!$vehiculo)
	           throw new Exception('No existe la vehiculo con id '.$id);
	           
	       
		   //si no me envian el formulario de confirmación
		   if(empty($_POST['confirmarborrado'])){
		      //mostrar el formularion de confirmación junto con los datos de la vehiculo
		      $datos = array();
		      $datos['usuario'] = Login::getUsuario();
		      $datos['vehiculo'] = $vehiculo; 
		      $this->load_view('view/vehiculos/confirmarborrado.php', $datos);
		   
		   //si me envian el formulario...
		   }else{
		      //borramos la vehiculo de la BDD
		      if(!VehiculoModel::borrar($id))
		          throw new Exception('No se pudo borrar, es posible que se haya borrado ya.');
		      
		      //borra la imagen de la vehiculo del servidor
		      unlink($vehiculo->imagen);    
		      
		      //cargar la vista de éxito
	          $datos = array();
	          $datos['usuario'] = Login::getUsuario();
	          $datos['mensaje'] = 'Operación de borrado ejecutada con éxito.';
	          $this->load_view('view/exito.php', $datos);
		          
		   }
		}

	
	
	}
?>