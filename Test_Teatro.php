<?php

include 'Teatro.php';
include 'Funciones.php';
include 'ObraTeatro.php';
include 'Musical.php';
include 'Cine.php';

$objObraTeatro = new ObraTeatro("Hamlet",array(20,0),array(1,0),100);
$objObraTeatroDos = new ObraTeatro("Romeo y Julieta",array(21,0),array(1,0),200);
$objMusical = new Musical("Foo Fighters",array(22,0),array(1,0),300,"Dave Grohl",1000);
$objCine = new Cine("Pulp Fiction",array(23,0),array(1,0),400,"Drama","Quentin Tarantino");


$funciones = array();
$funciones[0]= $objObraTeatro;
$funciones[1]= $objObraTeatroDos;
$funciones[2]= $objMusical;
$funciones[3]= $objCine;
  
$t = new Teatro("Teatro Colon","Cerrito 628");
 
$t->setFunciones($funciones);


function seleccionarOpcion(){
    
    $opcion = 0; 
    $opcionValida = false;
 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Cambiar nombre del teatro";
    echo "\n ( 2 ) Cambiar direccion del teatro"; 
    echo "\n ( 3 ) Cambiar nombre de la funcion";
    echo "\n ( 4 ) Cambiar precio de la funcion";
    echo "\n ( 5 ) Agregar una funcion";
    echo "\n ( 6 ) Ver funciones del teatro";
    echo "\n ( 7 ) Ver costo total del teatro";
    echo "\n ( 8 ) Salir";
    echo "\n--------------------------------------------------------------\n";  
 
    while ($opcionValida == false) {
       
     echo "Indique una opcion valida: ";
     $opcion = trim(fgets(STDIN));
 
     $opcionValida = $opcion == '1' || $opcion == '2' || $opcion == '3' || $opcion == '4' || $opcion == '5' || $opcion == '6'|| $opcion == '7'|| $opcion == '8';
 
    }
      
     return $opcion;
 }



do{ 
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: //Cambiar nombre del teatro
            echo "Ingrese el nuevo nombre del teatro";
            $nuevoNombre = trim(fgets(STDIN));
            $t->cambiarNombreTeatro($nuevoNombre);
            break;
        case 2: //Cambiar dirección del teatro
            echo "Ingrese la nueva direccion del teatro";
            $nuevaDireccion = trim(fgets(STDIN));
            $t->cambiarDireccion($nuevaDireccion);
            break;
        case 3: //Cambiar nombre de la función
            echo $t."\n";
            echo "Ingrese el nombre de la funcion que quiere cambiar \n";
            $busca = trim(fgets(STDIN));
            echo "Ingrese el nuevo nombre de la funcion \n";
            $nuevoNombre = trim(fgets(STDIN));
            $seCambio = $t->cambiarNombreFuncion($busca, $nuevoNombre);

            if (!$seCambio) {
                echo "No se pudo cambiar el nombre de la funcion!!!!!!!!!!!!!!!!!!!!!!!\n";
            }

            break;
        case 4: //Cambiar el precio de la función 
            echo $t."\n";
            echo "Ingrese el nombre de la funcion que quiere cambiar \n";
            $busca = trim(fgets(STDIN));
            echo "Ingrese el nuevo precio de la funcion \n";
            $nuevoPrecio = trim(fgets(STDIN));
            $seCambio = $t->cambiarPrecioFuncion($busca, $nuevoPrecio);
            if (!$seCambio) {
                echo "No se pudo cambiar el precio de la funcion!!!!!!!!!!!!!!!!!!!!!!!\n";
            }
            break;
        case 5: //Agregar una función

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

            $arrayInicioFuncion = array($nuevoHrInicioFuncion,$nuevoMinInicioFuncion);
            $arrayDuracionFuncion = array($nuevaHrDuracionFuncion,$nuevoMinDuracionFuncion);

            if ($tipoFuncion==1) {
                $nuevoObjetoFuncion = new Teatro($nuevoNombreFuncion,$arrayInicioFuncion,$arrayDuracionFuncion,$nuevoPrecioFuncion);
            }if ($tipoFuncion==2) {
                echo "Ingrese el nombre del director \n";
                $nuevoDirector = trim(fgets(STDIN));
                echo "Ingrese la cantidad de personas \n";
                $nuevaCantidadPersonas = trim(fgets(STDIN));
                $nuevoObjetoFuncion = new Musical($nuevoNombreFuncion,$arrayInicioFuncion,$arrayDuracionFuncion,$nuevoPrecioFuncion,$nuevoDirector,$nuevaCantidadPersonas );
            }if ($tipoFuncion==3) {
                echo "Ingrese el genero \n";
                $nuevoGenero = trim(fgets(STDIN));
                echo "Ingrese el pais de origen \n";
                $nuevoPaisOrigen = trim(fgets(STDIN));
                $nuevoObjetoFuncion = new Cine($nuevoNombreFuncion,$arrayInicioFuncion,$arrayDuracionFuncion,$nuevoPrecioFuncion,$nuevoGenero,$nuevoPaisOrigen);
            }
            //control horarios, metodo que verifica que el horario no este ocupado
            $horarioOcupado = $nuevoObjetoFuncion->controlHorarios($funciones);

            if (!$horarioOcupado) {
                $posicion= count($funciones);
                $funciones[$posicion]= $nuevoObjetoFuncion;
                $t->setFunciones($funciones);
            }
            else{
                echo "Ya existe una funcion en ese horario!!!!!!! \n";
            }
            
            break;
        case 6: //Mostrar los datos del teatro
            echo $t;
            break;
        case 7: //Mostrar el costo total
            echo "El costo total es: ". $t->sumarCosto()."\n";
            break;    
    }
}while($opcion != 8);