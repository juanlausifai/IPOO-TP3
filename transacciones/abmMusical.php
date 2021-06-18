<?php

class abmMusical{

    function insertarMusical($idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$director,$cantidadPersonas){
        
        $arregloAsociativo=array(
            "idfunciones"=>null,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
            "director"=>$director,
            "cantidadPersonas" =>$cantidadPersonas,
        
        );

        $objMusical = new Musical();
        $objMusical->cargar($arregloAsociativo);
        $objMusical->insertar();
    }

    function modificarMusical($idfunciones,$idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$director,$cantidadPersonas){
        
        $arregloAsociativo=array(
            "idfunciones"=>$idfunciones,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
            "director"=>$director,
            "cantidadPersonas" =>$cantidadPersonas,
        
        );

        $objMusical = new Musical();
        $objMusical->cargar($arregloAsociativo);
        $objMusical->modificar();
    }

    function eliminarMusical($idfunciones){
        $objMusical = new Musical();
        $objMusical->setIdfunciones($idfunciones);
        $objMusical->eliminar(); 
    }

}
