<?php
    require '../../config/Config.php';
    require '../../libraries/database_library.php';
    require '../VehiculoModel.php';

    //TEST GUARDAR VEHICULO
    //creamos un objeto vehículo
    /*$vehiculo = new VehiculoModel();
    $vehiculo->matricula = "5438abc";
    $vehiculo->modelo = "Ibiza";
    $vehiculo->color = "rojo";
    $vehiculo->precio_venta = 10000;
    $vehiculo->precio_compra = 4000;
    $vehiculo->kms = 90000;
    $vehiculo->caballos = 100;
    $vehiculo->estado Vehicul= 1;
    $vehiculo->any_matriculacion = 2008;
    $vehiculo->detalles ="presenta desperfectos en el frontal";
    $vehiculo->imagen = "aqui va la ruta de la imagen";
    $vehiculo->marca = "opel";
    
    $vehiculo->guardar();*/
   
    
    
    //TEST RECUPERAR
    //var_dump(VehiculoModel::getVehiculo(2));
    
    //$marcas = MarcaModel::getMarcas(10, 0, 't', 'DESC');
    
       // foreach($marcas as $m){
          //  echo"<p>$m->marc</p>;
        //}
    
    //TEST ACTUALIZAR
    //echo MarcaModel::actualizar('Citroën', 'Citroen');
    //$vehiculo = VehiculoModel::getVehiculo(3);
    //$vehiculo->matricula = '0000ABC';
    //$vehiculo->any_matriculacion=2007;
    //$vehiculo->color='negro metalizado';
    //$vehiculo->precio_venta=12000;
    //$vehiculo->actualizar();
    
    
    //VehiculoModel::borrar(3); //con método static
    
    //$prueba= new VehiculoModel(); // con método objeto primero crear objeto
    //$prueba->borrar2(); //llamar al objeto para usar el método
    
    
    //TEST BORRAR
    //Borrar el registro 2 por clase
        //borrar objeto
        //VehiculoModel::borrar(2);
        
    //Borrar el registro 3 por objeto
        //recuperar el objeto
       //$prueba = VehiculoModel::getVehiculo(3);
       //borrar objeto
        //$prueba->borrar2();
        
    
?>

