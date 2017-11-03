<?php
	class VehiculoModel{
		//PROPIEDADES
		public $id, $matricula, $modelo, $color, $precio_venta; 
		public $precio_compra, $kms, $caballos, $fecha_venta;
		public $estado, $any_matriculacion, $detalles, $imagen, $vendedor, $marca;
			
		//METODOS
		//guarda la vehiculo en la BDD
		//PROTOTIPO public boolean guardar()
		public function guardar(){
			$consulta = "INSERT INTO vehiculos(matricula, modelo, color, precio_venta, precio_compra,
			             kms, caballos, estado, any_matriculacion, detalles, imagen, marca)
			             VALUES (
                                '$this->matricula',
                                '$this->modelo',
                                '$this->color',
                                $this->precio_venta, 
                                $this->precio_compra,
                                $this->kms,
                                $this->caballos,
                                $this->estado,
                                $this->any_matriculacion,
                                '$this->detalles',
                                '$this->imagen',
                                '$this->marca'
			                 );";
			return Database::get()->query($consulta);
		}
		
		
		//método que me recupera el total de registros (incluso con filtros)
		public static function getTotal($t='', $c='marca'){
		    $consulta = "SELECT * FROM vehiculos
                         WHERE $c LIKE '%$t%'";
		    
		    $conexion = Database::get();
		    $resultados = $conexion->query($consulta);
		    $total = $resultados->num_rows;
		    $resultados->free();
		    return $total;
		}
		
		
		//método que me recupere todas las vehiculos
		//PROTOTIPO: public static array<VehiculoModel> getVehiculos()
		public static function getVehiculos($l=10, $o=0, $t='', $c='modelo', $co='id', $so='ASC'){
		    //preparar la consulta
		    $consulta = "SELECT * FROM vehiculos
                         WHERE $c LIKE '%$t%'
                         ORDER BY $co $so
		                 LIMIT $l
		                 OFFSET $o;";
		    
		    //conecto a la BDD y ejecuto la consulta
		    $conexion = Database::get();
		    $resultados = $conexion->query($consulta);
		    
		    //creo la lista de VehiculoModel
		    $lista = array();
		    while($vehiculo = $resultados->fetch_object('VehiculoModel'))
		      $lista[] = $vehiculo; 
		        
		    //liberar memoria
		    $resultados->free();
		    
		    //retornar la lista de VehiculoModel
		    return $lista;
		}
		
		
		//Método que me recupera un vehiculo a partir de su ID
		//PROTOTIPO: public static VehiculoModel getVehiculo(number $id=0);
		public static function getVehiculo($id=0){
		    //preparar consulta
		    $consulta = "SELECT * FROM vehiculos WHERE id=$id;";
		    
		    //ejecutar consulta
		    $conexion = Database::get();
		    $resultado = $conexion->query($consulta);
		    
		    //si no había resultados, retornamos NULL
		    if(!$resultado) return null;
		    
		    //convertir el resultado en un objeto VehiculoModel
		    $vehiculo = $resultado->fetch_object('VehiculoModel');
		    
		    //liberar memoria
		    $resultado->free();
		    
		    //devolver el resultado
		    return $vehiculo;
		}
		
	    //actualiza los datos del usuario en la BDD
	    //PROTOTIPO: public boolean actualizar();
		public function actualizar(){
			$consulta = "UPDATE vehiculos
					     SET matricula='$this->matricula', 
						     modelo='$this->modelo',
                             color='$this->color',
                             precio_venta=$this->precio_venta, 
						  	 precio_compra=$this->precio_compra,
                             kms=$this->kms,
                             caballos=$this->caballos,
                             any_matriculacion=$this->any_matriculacion,
                             detalles='$this->detalles',
                             imagen='$this->imagen',
                             marca='$this->marca',
                            estado=$this->estado
						  WHERE id=$this->id;";
			return Database::get()->query($consulta);
		}
		
		
		//Método que borra una vehiculo de la BDD (estático)
		//PROTOTIPO: public static boolean borrar(int $id)
		public static function borrar($id){
		    $consulta = "DELETE FROM vehiculos
                         WHERE id=$id;";
		    
		    $conexion = Database::get(); //conecta
		    $conexion->query($consulta); //ejecuta consulta
		    return $conexion->affected_rows; //devuelve el num de filas afectadas
		}
		
		//EJEMPLO DE USO
		//RecetaModel::borrar(6)
		
		
		
		//Método que borra una vehiculo de la BDD (de objeto)
		//PROTOTIPO: public boolean borrar2()
		public function borrar2(){
			$consulta = "DELETE FROM vehiculos 
                         WHERE id=$this->id;";
			
			$conexion = Database::get(); //conecta
			$conexion->query($consulta); //ejecuta consulta
			return $conexion->affected_rows; //devuelve el num de filas afectadas
		}
		
		//ALTERNATIVA al método anterior
		//en este caso, el método borrar2 llama al método estático borrar
		/*
		public function borrar2(){
		    return self::borrar($this->id); //devuelve el num de filas afectadas
		}
		*/
        
		//EJEMPLO DE USO (1):
		// $vehiculo = RecetaModel::getReceta(6);
		// $vehiculo->borrar2();
		
		//EJEMPLO DE USO (2):
		// $vehiculo = new Receta();
		// $vehiculo->id = 6;
		// $vehiculo->borrar2();
	}
?>