<?php
require '../../config/Config.php';
require '../../libraries/database_library.php';
require '../VehiculoModel.php';

//TEST GUARDAR VEHICULO
//creamos un objeto vehículo
/*$vehiculo = new VehiculoModel();
 $vehiculo->matricula = "5555ABC";
 $vehiculo->modelo = "A4";
 $vehiculo->color = "blanco";
 $vehiculo->precio_venta = 11000;
 $vehiculo->precio_compra = 6000;
 $vehiculo->kms = 40000;
 $vehiculo->caballos = 100;
 $vehiculo->estado = 1;
 $vehiculo->any_matriculacion = 2000;
 $vehiculo->detalles ="presenta desperfectos en el frontal";
 $vehiculo->imagen = "aqui va la ruta de la imagen";
 $vehiculo->marca = "BMW";
 $vehiculo->vendedor = "";
 var_dump($vehiculo);
 $vehiculo->guardar();*/



//TEST RECUPERAR
//var_dump(VehiculoModel::getVehiculo(2));

//$marcas = MarcaModel::getMarcas(10, 0, 't', 'DESC');

// foreach($marcas as $m){
//  echo"<p>$m->marc</p>;
//}

//TEST ACTUALIZAR
//echo MarcaModel::actualizar('Citroën', 'Citroen');
//$vehiculo = VehiculoModel::getVehiculo(7);
//$vehiculo->matricula = '0000ABC';
//$vehiculo->modelo = "Ampera";
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