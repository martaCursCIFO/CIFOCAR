<?php
class UsuarioModel{
    //PROPIEDADES
    public $id, $user, $password, $nombre, $privilegio, $admin=0, $email, $imagen='', $fecha;
    
    //METODOS
    //guarda el usuario en la BDD
    public function guardar(){
        $user_table = Config::get()->db_user_table;
        // creamos la consulta
        $consulta = "INSERT INTO $user_table(user, password, nombre, privilegio, admin, email, imagen)
			VALUES ('$this->user','$this->password','$this->nombre',$this->privilegio,$this->admin,'$this->email', '$this->imagen');";
        
        return Database::get()->query($consulta);
    }
    
    
    //actualiza los datos del usuario en la BDD por usuario
    public function actualizar(){
        $user_table = Config::get()->db_user_table;
        $consulta = "UPDATE $user_table
							  SET password='$this->password',
							  		nombre='$this->nombre',
							  		email='$this->email',
							  		imagen='$this->imagen'
							  WHERE user='$this->user';";
        return Database::get()->query($consulta);
    }
    
    //actualiza los datos del usuario en la BDD por Admin
    public function actualizarAdmin(){
        $user_table = Config::get()->db_user_table;
        $consulta = "UPDATE $user_table
							  SET privilegio=$this->privilegio,
                                        email='$this->email',
                                        admin=$this->admin
                                WHERE user='$this->user';";
        return Database::get()->query($consulta);
    }
    
    //elimina el usuario de la BDD
    public function borrar(){
        $user_table = Config::get()->db_user_table;
        $consulta = "DELETE FROM $user_table WHERE user='$this->user';";
        return Database::get()->query($consulta);
    }
    
    
    
    //este método sirve para comprobar user y password (en la BDD)
    public static function validar($u, $p){
        $user_table = Config::get()->db_user_table;
        $consulta = "SELECT * FROM $user_table WHERE user='$u' AND password='$p';";
        $resultado = Database::get()->query($consulta);
        
        //si hay algun usuario retornar true sino false
        $r = $resultado->num_rows;
        $resultado->free(); //libera el recurso resultset
        return $r;
    }
    
    //este método debería retornar un usuario creado con los datos
    //de la BDD (o NULL si no existe), a partir de un nombre de usuario
    public static function getUsuario($u){
        $user_table = Config::get()->db_user_table;
        $consulta = "SELECT * FROM $user_table WHERE user='$u';";
        $resultado = Database::get()->query($consulta);
        
        $us = $resultado->fetch_object('UsuarioModel');
        $resultado->free();
        return $us;
    }
    
    
    public static function getUsuarioPorId($id){
        $user_table = Config::get()->db_user_table;
        $consulta = "SELECT * FROM $user_table WHERE id=$id;";
        
        $resultado = Database::get()->query($consulta);
        
        $us = $resultado->fetch_object('UsuarioModel');
        $resultado->free();
        return $us;
    }
    
    //método que me recupera el total de registros (incluso con filtros)
    public static function getTotal($t='', $c='user'){
        $consulta = "SELECT * FROM usuarios
                         WHERE $c LIKE '%$t%'";
        
        $conexion = Database::get();
        $resultados = $conexion->query($consulta);
        $total = $resultados->num_rows;
        $resultados->free();
        return $total;
    }
    
    // Este metodo recupera todos los usuarios
    public static function getUsuarios($l=10, $o=0, $t='', $c='nombre', $co='nombre', $so='ASC'){
        // preparar consulta

        $consulta = "SELECT * FROM usuarios
                         WHERE $c LIKE '%$t%'
                         ORDER BY $co $so
		                 LIMIT $l
		                 OFFSET $o;";
        
        // conectar BDD
        $conexion = Database::get();
        // ejecutar consulta
        $resultado = $conexion->query($consulta);
        // crear array
        $lista = array();
        
        // llenamos la lista con los resultados transformado en objetos UsuarioModel
        while ($usuario=$resultado->fetch_object('UsuarioModel'))
            $lista[]=$usuario;
            
            $resultado->free();
            return $lista;
    }
    
}
?>