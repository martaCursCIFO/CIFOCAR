<?php
	//CONTROLADOR marca 
	class  Marca extends Controller{

		//PROCEDIMIENTO PARA GUARDAR UNA NUEVA MARCA
		public function nuevaMarca(){
		    //comprobar si eres responsalbe de compras
		    if(!Login::getUsuario() || login::getUsuario()->privilegio!=1)
		        throw new Exception('Debes ser Responsable de Compras');

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$this->load_view('view/marca/nuevaMarca.php', $datos);
			
			//si llegan los datos por POST
			}else{
							
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$marca = $_POST['marca'];
				
				//cargamos el modelo
				$this->load("model/MarcaModel.php");

							
				//guardar la marca en BDD
				if(!MarcaModel::guardar($marca)){
				    throw new Exception('No se pudo guardar la marca '.$marca);
				}
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de guardado completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		
		//PROCEDIMIENTO PARA LISTAR LAS MARCAS
		public function listarMarcas($pagina){
		    //comprobar si eres responsalbe de compras
		    if(!Login::getUsuario() || login::getUsuario()->privilegio!=1)
		        throw new Exception('Debes ser Responsable de Compras');
		    
		    $this->load('model/MarcaModel.php');
		    
		    //si me piden APLICAR un filtro
		    if(!empty($_POST['filtrar'])){
		        //recupera el filtro a aplicar
		        $f = new stdClass(); //filtro
		        $f->texto = htmlspecialchars($_POST['texto']);
		        $f->sentidoOrden = htmlspecialchars($_POST['sentidoOrden']);
		        
		        //guarda el filtro en un var de sesión
		        $_SESSION['filtromarcas'] = serialize($f);
		    }
		  
		    //si me piden QUITAR un filtro
		    if(!empty($_POST['quitarFiltro']))
		        unset($_SESSION['filtromarcas']); 
		    
	        //comprobar si hay filtro
	        $filtro = empty($_SESSION['filtromarcas'])? false : unserialize($_SESSION['filtromarcas']);
		        
		    //para la paginación
		    $num = 10; //numero de resultados por página
		    $pagina = abs(intval($pagina)); //para evitar cosas raras por url
		    $pagina = empty($pagina)? 1 : $pagina; //página a mostrar
		    $offset = $num*($pagina-1); //offset
		    
		    //si no hay que filtrar los resultados...
		    if(!$filtro){
		      //recupera todas las marcas
		      $marcas = MarcaModel::getMarcas($num, $offset);
		      //total de registros (para paginación)
		      $totalRegistros = MarcaModel::getTotal();
		    }else{
		      //recupera las marcas con el filtro aplicado
		      $marcas = MarcaModel::getMarcas($num, $offset, $filtro->texto, $filtro->sentidoOrden);
		      //total de registros (para paginación)
		      $totalRegistros = MarcaModel::getTotal($filtro->texto, $filtro->campo);
		    }
		    
		    //cargar la vista del listado
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['marcas'] = $marcas;
		    $datos['filtro'] = $filtro;
		    $datos['paginaActual'] = $pagina;
		    $datos['paginas'] = ceil($totalRegistros/$num); //total de páginas (para paginación)
		    $datos['totalRegistros'] = $totalRegistros;
		    $datos['regPorPagina'] = $num;
		    
		    $this->load_view('view/marca/listarmarcas.php', $datos);
		}
		
		
		
		//PROCEDIMIENTO PARA EDITAR UN MARCA
		public function editar($marcaAntigua){
		    //comprobar si eres responsalbe de compras
		    if(!Login::getUsuario() || login::getUsuario()->privilegio!=1)
		        throw new Exception('Debes ser Responsable de Compras');
		   //var_dump($marcaAntigua);
		    $this->load('model/MarcaModel.php');
		    //comprobar que me llega una marca
		    if(!$marcaAntigua)
		        throw new Exception('No se indicó la marca o no existe');	        	        
		    
		    //si no me están enviando el formulario
		    if(empty($_POST['modificar'])){
		      //poner el formulario
		        $datos = array();
		        $datos['usuario'] = Login::getUsuario();
		        $datos['marca'] = $marcaAntigua;
		        $this->load_view('view/marca/modificarMarca.php', $datos);

		    }else{
		    //en caso contrario
		      $conexion = Database::get();
		      //actualizar los campos de la marca con los datos POST
		      $marcaNueva = $_POST['marca'];
		      
		      //modificar la marca en la BDD
		      if(!MarcaModel::actualizar($marcaNueva, $marcaAntigua))
		          throw new Exception('No se pudo actualizar');
		      
		      //cargar la vista de éxito 
	          $datos = array();
	          $datos['usuario'] = Login::getUsuario();
	          $datos['mensaje'] = "Datos de la marca actualizados correctamente.";
	          $this->load_view('view/exito.php', $datos);
		    }
		}
		
		//PROCEDIMIENTO PARA BORRAR UNA marca
		public function borrar($marca=""){
		    //comprobar si eres responsalbe de compras
		    if(!Login::getUsuario() || login::getUsuario()->privilegio!=1)
		        throw new Exception('Debes ser Responsable de Compras');
		   
		   $this->load('model/MarcaModel.php');
	       //comprobar que se ha indicado un id
	       if(!$marca)
	           throw new Exception('No se indicó la marca a borrar o no existe');
		      
	       
		   //si no me envian el formulario de confirmación
		   if(empty($_POST['confirmarborrado'])){
		      //mostrar el formularion de confirmación junto con los datos de la marca
		      $datos = array();
		      $datos['usuario'] = Login::getUsuario();
		      $datos['marca'] = $marca; 
		      $this->load_view('view/marca/confirmarborrado.php', $datos);
		   
		   //si me envian el formulario...
		   }else{
		      //borramos la marca de la BDD
		      if(!MarcaModel::borrar($marca))
		          throw new Exception('No se pudo borrar, es posible que se haya borrado ya.');
		      
		      //cargar la vista de éxito
	          $datos = array();
	          $datos['usuario'] = Login::getUsuario();
	          $datos['mensaje'] = 'Operación de borrado ejecutada con éxito.';
	          $this->load_view('view/exito.php', $datos);
		          
		   }
		}

	
	
	}
?>