<?php
	class MarcaModel{
		
		//guarda la marca del vehículo en la BDD
		public static function guardar($marca){
			$consulta = "INSERT INTO marcas
                         VALUES ('$marca');";
			
			return Database::get()->query($consulta);
		}
		
		
		//recuperar la marca del vehículo (con filtros)
		public static function getMarcas($l=0, $o=0, $texto='', $sentido='ASC'){
		    $consulta = "SELECT * FROM marcas
		                 WHERE marca LIKE '%$texto%'
                         ORDER BY marca $sentido ";
            if($l>0) $consulta.="LIMIT $l ";
            if($o>0) $consulta.="OFFSET $o";
		    
            //echo $consulta;
            
		    //ejecutar la consulta
		    $resultados = Database::get()->query($consulta);
		    
		    //prepara la lista
		    $lista=array();
		    
		    //rellenar la lista con los resultados
		    while($marca = $resultados->fetch_object('MarcaModel'))
		        $lista[] = $marca;
		    
		    $resultados->free();
		    return $lista;
		}
		
		
		//actualizar la marca del vehículo
		public static function actualizar($new, $old){
		    //preparar consulta
		    $consulta = "UPDATE marcas
                            SET marca='$new'
                            WHERE marca='$old';";
		    //ejecutar consulta
		    
		    //retornar número de filas afectadas
		    return Database::get()->query($consulta);
		}
		
		//borrar la marca del vehículo
		public static function borrar($marca){
		    //preparar consulta
		    $consulta = "DELETE FROM marcas
                         WHERE marca='$marca';";
		    
		    //ejecutar consulta
		    Database::get()->query($consulta);
		    
		    //retornar número de filas afectadas
		    return Database::get()->affected_rows;
		}  
		
		//método que me recupera el total de registros (incluso con filtros)
		public static function getTotal($t='', $c='marca'){
		    $consulta = "SELECT * FROM marcas
		                 WHERE $c LIKE '%$t%'";
		    
		    $conexion = Database::get();
		    $resultados = $conexion->query($consulta);
		    $total = $resultados->num_rows;
		    $resultados->free();
		    return $total;
		}
	}
?>
