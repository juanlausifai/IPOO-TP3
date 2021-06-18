<?php

class abmObraTeatro{

    function insertarObraTeatro($idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion){
        
        $arregloAsociativo=array(
            "idfunciones"=>null,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
        );

        $objObraTeatro = new ObraTeatro();
        $objObraTeatro->cargar($arregloAsociativo);
        $objObraTeatro->insertar();
    }


    function modificarObraTeatro($idfunciones,$idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion){
        
        $arregloAsociativo=array(
            "idfunciones"=>$idfunciones,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
        );

        $objObraTeatro = new ObraTeatro();
        $objObraTeatro->cargar($arregloAsociativo);
        $objObraTeatro->modificar();
    }

    function eliminarObraTeatro($idfunciones){
        $objObraTeatro = new ObraTeatro();
        $objObraTeatro->setIdfunciones($idfunciones);
        $objObraTeatro->eliminar(); 
    }


}