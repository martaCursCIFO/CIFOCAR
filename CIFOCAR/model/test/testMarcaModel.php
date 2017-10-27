<?php
    require '../../config/Config.php';
    require '../../libraries/database_library.php';
    require '../MarcaModel.php';

    //TEST GUARDAR MARCA
    MarcaModel::guardar('opel');
    
    //TEST RECUPERAR
    //var_dump(MarcaModel::getMarcas());
    
    //$marcas = MarcaModel::getMarcas(10, 0, 't', 'DESC');
    
        //foreach($marcas as $m){
           // echo"<p>$m->marc</p>;
        //}
    
    //TEST ACTUALIZAR
    //echo MarcaModel::actualizar('Citroën', 'Citroen');
    
    //TEST BORRAR
    //echo MarcaModel::borrar('Fiat');
        
?>

