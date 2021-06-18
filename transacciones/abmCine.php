<?php 

class abmCine{
    
    function insertarCine($idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoGenero,$nuevoPaisOrigen){
        
        $arregloAsociativo=array(
            "idfunciones"=>null,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
            "genero"=>$nuevoGenero,
            "paisOrigen" =>$nuevoPaisOrigen,
        
        );

        $objCine = new Cine();
        $objCine->cargar($arregloAsociativo);
        $objCine->insertar();
    }

    function modificarCine($idfunciones,$idteatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoGenero,$nuevoPaisOrigen){
        
        $arregloAsociativo=array(
            "idfunciones"=>$idfunciones,
            "idteatro"=>$idteatro,
            "nombre"=>$nuevoNombreFuncion,
            "hora_inicio"=>$hrInicio,
            "duracion_obra"=>$hrDuracion,
            "precio"=>$nuevoPrecioFuncion,
            "genero"=>$nuevoGenero,
            "paisOrigen" =>$nuevoPaisOrigen,
        );

        $objCine = new Cine();
        $objCine->cargar($arregloAsociativo);
        $objCine->modificar();
    }


    function eliminarCine($idfunciones){
        $objCine = new Cine();
        $objCine->setIdfunciones($idfunciones);
        $objCine->eliminar(); 
    }
}