<?php

class abmFunciones{

    function insertarFuncion($idteatro,$nombre,$horarioInicio,$duracion_obra,$precio){
        $objFuncion = new Funciones();
        $objFuncion->setObjTeatro($idteatro);
        $objFuncion->setNombre($nombre);
        $objFuncion->setHorario_inicio($horarioInicio);
        $objFuncion->setDuracion_obra($duracion_obra);
        $objFuncion->setPrecio($precio);
        $objFuncion->insertar();

        
    }
    
    function modificarNombreFuncion($objFuncion,$nombre){
        $objFuncion->setNombre($nombre);
        $objFuncion->modificar();
    }

    function modificarPrecioFuncion($objFuncion,$precio){
        $objFuncion->setPrecio($precio);
        $objFuncion->modificar();
    }

    function seleccionFuncion($idFuncion){
        $objFuncion= new Funciones();
        $objFuncion->buscar($idFuncion);
        return $objFuncion;
    }

    function eliminarFuncion($objFuncion){
        $objFuncion->eliminar();
    }

}