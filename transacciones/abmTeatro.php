<?php

class abmTeatro{

    function insertarTeatro($nombre,$direccion){
        $objTeatro = new Teatro();
        $objTeatro->setNombre($nombre);
        $objTeatro->setDireccion($direccion);
        $objTeatro->insertar();
    }

    
    function modificarTeatro($objTeatro,$nombre,$direccion){
        $objTeatro->setNombre($nombre);
        $objTeatro->setDireccion($direccion);
        $objTeatro->modificar();
    }


    function seleccionTeatro($idTeatro){
        $objTeatro= new Teatro();
        $objTeatro->buscar($idTeatro);
        return $objTeatro;
    }

    function listarTeatros(){
        $objTeatro= new Teatro();
        $listadoTeatros= $objTeatro->listar();
        
        foreach ($listadoTeatros as $teatro) {
            echo "id: ".$teatro->getIdteatro()." ,Teatro: ".$teatro->getNombre()."\n";
        }
        
    }

    function eliminarTeatro($objTeatro){
        $funciones=$objTeatro->getFunciones();
        
        foreach ($funciones as $funcion) {
            $funcion->eliminar();
        }

        $objTeatro->eliminar();
    }

}