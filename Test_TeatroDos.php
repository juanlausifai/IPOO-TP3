<?php

include_once 'ORM/BaseDatos.php';
include_once 'ORM/Teatro.php';
include_once 'ORM/Funciones.php';
include_once 'ORM/Cine.php';
include_once 'ORM/Musical.php';
include_once 'ORM/ObraTeatro.php';

include_once 'transacciones/abmTeatro.php';
//include_once 'transacciones/abmFunciones.php';
include_once 'transacciones/abmCine.php';
include_once 'transacciones/abmMusical.php';
include_once 'transacciones/abmObraTeatro.php';

$t = new abmTeatro();
//$f=new abmFunciones();
$m=new abmMusical;
$o=new abmObraTeatro;
$c=new abmCine();



function seleccionarOpcion(){
    
    $opcion = 0; 
    $opcionValida = false;
 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Agregar teatro";
    echo "\n ( 2 ) Editar teatro"; 
    echo "\n ( 3 ) Eliminar Teatro";
    echo "\n ( 4 ) Agregar funcion";
    echo "\n ( 5 ) Editar una funcion";
    echo "\n ( 6 ) Eliminar una funcion";
    echo "\n ( 7 ) Ver funciones del teatro";
    echo "\n ( 8 ) Total de costo por teatro";
    echo "\n ( 9 ) Salir";
    echo "\n--------------------------------------------------------------\n";  
 
    while ($opcionValida == false) {
       
     echo "Indique una opcion valida: ";
     $opcion = trim(fgets(STDIN));
 
     $opcionValida = $opcion == '1' || $opcion == '2' || $opcion == '3' || $opcion == '4' || $opcion == '5' || $opcion == '6'|| $opcion == '7'|| $opcion == '8'|| $opcion == '9';
 
    }
      
     return $opcion;
 }



do{ 
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: //Agregar un teatro
            echo "Ingrese el nombre del teatro\n";
            $nuevoNombre = trim(fgets(STDIN));
            echo "Ingrese la direccion del teatro\n";
            $nuevaDireccion = trim(fgets(STDIN));
            $t->insertarTeatro($nuevoNombre,$nuevaDireccion);
            break;
        case 2: //editar un teatro
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea modificar\n";
            $idteatro = trim(fgets(STDIN));
            echo "Ingrese el nuevo nombre del teatro\n";
            $nuevoNombre = trim(fgets(STDIN));
            echo "Ingrese la nueva direccion del teatro\n";
            $nuevaDireccion = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            $t->modificarTeatro($objTeatro,$nuevoNombre,$nuevaDireccion);
            break;
        case 3: //Eliminar Teatro
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea eliminar\n";
            $idteatro = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            $t->eliminarTeatro($objTeatro);
            break;
        case 4: //Agregar funcion 
            $t->listarTeatros();
            
            echo "Ingrese el id del teatro para el que desea agregar una funcion\n";
            $idteatro = trim(fgets(STDIN));
            
           
            echo "Ingrese el tipo funcion \n Obra de teatro:1\n Musical:2\n Cine:3\n";
            $tipoFuncion = trim(fgets(STDIN));

            if ($tipoFuncion==1) {
                $tipoNombre="de la Obra de teatro";
            }if ($tipoFuncion==2) {
                $tipoNombre="del musical";
            }if ($tipoFuncion==3) {
                $tipoNombre="de la pelicula";
            }

            echo "Ingrese el nombre ".$tipoNombre." \n";
            $nuevoNombreFuncion = trim(fgets(STDIN));
            /*echo "Ingrese la hora de la hora de inicio \n";
            $nuevoHrInicioFuncion = trim(fgets(STDIN));
            echo "Ingrese los minutos de la hora de inicio \n";
            $nuevoMinInicioFuncion = trim(fgets(STDIN));  
            echo "Ingrese la hora de la duracion ".$tipoNombre." \n";
            $nuevaHrDuracionFuncion = trim(fgets(STDIN));
            echo "Ingrese los minutos de la duracion".$tipoNombre. "\n";
            $nuevoMinDuracionFuncion = trim(fgets(STDIN));
            echo "Ingrese el precio ".$tipoNombre." \n";
            $nuevoPrecioFuncion = trim(fgets(STDIN));
            
            $hrInicio = $nuevoHrInicioFuncion.":".$nuevoMinInicioFuncion;
            $hrDuracion =$nuevaHrDuracionFuncion.":".$nuevoMinDuracionFuncion;*/

           
            //control de horario
            do {
                echo "Ingrese la hora de la hora de inicio \n";
                $nuevoHrInicioFuncion = trim(fgets(STDIN));
                echo "Ingrese los minutos de la hora de inicio \n";
                $nuevoMinInicioFuncion = trim(fgets(STDIN));  
                echo "Ingrese la hora de la duracion ".$tipoNombre." \n";
                $nuevaHrDuracionFuncion = trim(fgets(STDIN));
                echo "Ingrese los minutos de la duracion".$tipoNombre. "\n";
                $nuevoMinDuracionFuncion = trim(fgets(STDIN));
                echo "Ingrese el precio ".$tipoNombre." \n";
                $nuevoPrecioFuncion = trim(fgets(STDIN));
                $hrInicio = $nuevoHrInicioFuncion.":".$nuevoMinInicioFuncion;
                $hrDuracion =$nuevaHrDuracionFuncion.":".$nuevoMinDuracionFuncion;
                $objTeatro= $t->seleccionTeatro($idteatro);
                $horario_ocupado=$objTeatro->controlHorarios($objTeatro,$hrInicio,$hrDuracion);
                if ($horario_ocupado) {
                    echo "Horario ocupado\n";
                    
                }
                if(!$horario_ocupado){
                    echo "Horario sin ocupar\n";
                   
                }
            } while ($horario_ocupado);

            
            if ($tipoFuncion == 1) {
                $o->insertarObraTeatro($objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion);
                
            }if ($tipoFuncion == 2) {
                echo "Ingrese el nombre del director \n";
                $nuevoDirector = trim(fgets(STDIN));
                echo "Ingrese la cantidad de personas \n";
                $nuevaCantidadPersonas = trim(fgets(STDIN));
                $m->insertarMusical($objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoDirector,$nuevaCantidadPersonas);
            }if ($tipoFuncion == 3) {
                echo "Ingrese el genero \n";
                $nuevoGenero = trim(fgets(STDIN));
                echo "Ingrese el pais de origen \n";
                $nuevoPaisOrigen = trim(fgets(STDIN));
                $c->insertarCine($objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoGenero,$nuevoPaisOrigen);
            }

            break;
        case 5: //Editar una funcion
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea ver\n";
            $idteatro = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            echo $objTeatro;
            $arrayFunciones =$objTeatro->getFunciones();
            echo "Ingrese el id de funcion que desea editar\n";
            $idfunciones = trim(fgets(STDIN));

            $i=0;
            $encontro = false;
            while ($i <= count($arrayFunciones) && !$encontro) {
                
                if ($arrayFunciones[$i]->getIdfunciones()==$idfunciones) {
                    $idEncontrado = $idfunciones;
                    $clase= get_class($arrayFunciones[$i]);
                    $encontro=true;
                }
                
                $i++;
            }

            if ($encontro) {
            echo "Ingrese el nombre "." \n";
            $nuevoNombreFuncion = trim(fgets(STDIN));
            echo "Ingrese la hora de la hora de inicio \n";
            $nuevoHrInicioFuncion = trim(fgets(STDIN));
            echo "Ingrese los minutos de la hora de inicio \n";
            $nuevoMinInicioFuncion = trim(fgets(STDIN));  
            echo "Ingrese la hora de la duracion "." \n";
            $nuevaHrDuracionFuncion = trim(fgets(STDIN));
            echo "Ingrese los minutos de la duracion". "\n";
            $nuevoMinDuracionFuncion = trim(fgets(STDIN));
            echo "Ingrese el precio "." \n";
            $nuevoPrecioFuncion = trim(fgets(STDIN));
            
            $hrInicio = $nuevoHrInicioFuncion.":".$nuevoMinInicioFuncion;
            $hrDuracion =$nuevaHrDuracionFuncion.":".$nuevoMinDuracionFuncion;

                /*echo $idEncontrado."\n";
                echo $clase;*/

                if ($clase=="Cine") {
                    echo "Ingrese el genero \n";
                    $nuevoGenero = trim(fgets(STDIN));
                    echo "Ingrese el pais de origen \n";
                    $nuevoPaisOrigen = trim(fgets(STDIN));
                    $c->modificarCine($idEncontrado,$objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoGenero,$nuevoPaisOrigen);
                }
                if ($clase=="Musical") {
                    echo "Ingrese el nombre del director \n";
                    $nuevoDirector = trim(fgets(STDIN));
                    echo "Ingrese la cantidad de personas \n";
                    $nuevaCantidadPersonas = trim(fgets(STDIN));
                    $m->modificarMusical($idEncontrado,$objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion,$nuevoDirector,$nuevaCantidadPersonas); 
                }
                if ($clase=="ObraTeatro") {
                    $o->modificarObraTeatro($idEncontrado,$objTeatro,$nuevoNombreFuncion,$hrInicio,$hrDuracion,$nuevoPrecioFuncion);   
                }
                
            }
            
            
            break;
        case 6: //Eliminar una funcion
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea ver\n";
            $idteatro = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            echo $objTeatro;
            $arrayFunciones =$objTeatro->getFunciones();
            echo "Ingrese el id de funcion que desea eliminar\n";
            $idfunciones = trim(fgets(STDIN));

            $i=0;
            $encontro = false;
            while ($i <= count($arrayFunciones) && !$encontro) {
                
                if ($arrayFunciones[$i]->getIdfunciones()==$idfunciones) {
                    $idEncontrado = $idfunciones;
                    $clase= get_class($arrayFunciones[$i]);
                    $encontro=true;
                }
                
                $i++;
            }

            if ($encontro) {

                if ($clase=="Cine") {
                    $c->eliminarCine($idEncontrado);
                }
                if ($clase=="Musical") {
                    $m->eliminarMusical($idEncontrado); 
                }
                if ($clase=="ObraTeatro") {
                    $o->eliminarObraTeatro($idEncontrado);   
                }

            }
            break;
        case 7: //Mostrar los datos del teatro
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea ver\n";
            $idteatro = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            echo $objTeatro."\n\n";
            break; 
        case 8: //Mostrar el costo por teatro
            $t->listarTeatros();
            echo "Ingrese el id del teatro que desea ver\n";
            $idteatro = trim(fgets(STDIN));
            $objTeatro= $t->seleccionTeatro($idteatro);
            echo "El costo total es: ". $objTeatro->sumarCosto()."\n\n";
            break;       
    }
}while($opcion != 9);
