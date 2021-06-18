<?php

Class Teatro{
    
    private $idteatro;
    private $nombre;
    private $direccion;
    private $funciones=[];
    private $mensajeoperacion;

    public function __construct()
    {   
        $this->idteatro = 0;
        $this->nombre = "";
        $this->direccion = "";
        $this->funciones = [];
    }

    /**
     * Get the value of idteatro
     */ 
    public function getIdteatro()
    {
        return $this->idteatro;
    }

    /**
     * Set the value of idteatro
     */ 
    public function setIdteatro($idteatro)
    {
        $this->idteatro = $idteatro;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get the value of funciones
     */ 
    public function getFunciones()
    {
        //return $this->funciones;
        
        if (count($this->funciones) == 0) {
            
            $objCine = new Cine();
            $objMusical = new Musical();
            $objObraTeatro = new ObraTeatro();

            $condicion = " idteatro=" . $this->getIdTeatro();

            $colCine = $objCine->listar($condicion);
            $colMusical = $objMusical->listar($condicion);
            $colObrasTeatro = $objObraTeatro->listar($condicion);
            $funciones = array_merge($colCine, $colMusical, $colObrasTeatro);
            $this->setFunciones($funciones);
        }
        
        return $this->funciones;
    }

    /**
     * Set the value of funciones
     */ 
    public function setFunciones($funciones)
    {
        $this->funciones = $funciones;
    }

    /**
     * Get the value of mensajeoperacion
     */ 
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * Set the value of mensajeoperacion
     */ 
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function cargar($paramTeatro){	
	    
        $this->setIdteatro($paramTeatro['idteatro']);
		$this->setNombre($paramTeatro['nombre']);
		$this->setDireccion($paramTeatro['direccion']);
		
    }

   /**
	 * Recupera los datos de un teatro por nombre
	 * @param int $idteatro
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idteatro){
		$base=new BaseDatos();
		$consultaTeatro="Select * from teatro where idteatro=".$idteatro;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaTeatro)){
				if($row2=$base->Registro()){
                    $this->setIdteatro($idteatro);
				    $this->setIdteatro($row2['idteatro']);
				    $this->setNombre($row2['nombre']);
					$this->setDireccion($row2['direccion']);

					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	


    public static function listar($condicion=""){
	    $arregloTeatro = null;
		$base=new BaseDatos();
		$consultaTeatros="Select * from teatro ";
		if ($condicion!=""){
		    $consultaTeatros=$consultaTeatros.' where '.$condicion;
		}
		$consultaTeatros.=" order by nombre ";
		//echo $consultaTeatros;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaTeatros)){				
				$arregloTeatro= array();
				while($row2=$base->Registro()){
				    $idteatro=$row2['idteatro'];
					$nombre=$row2['nombre'];
					$direccion=$row2['direccion'];
				
					$teatro= new Teatro();
                    $arregloAsociativoTeatro= array(
                        'idteatro'=>$idteatro,
                        'nombre'=>$nombre,
                        'direccion'=>$direccion,
                    );

					$teatro->cargar($arregloAsociativoTeatro);
					array_push($arregloTeatro,$teatro);
				}
			
		 	}	else {
		 			//$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		//$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloTeatro;
	}


    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO teatro(nombre, direccion) 
				VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdteatro($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}


    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE teatro SET nombre='".$this->getNombre()."',direccion='". $this->getDireccion()."' WHERE idteatro =".$this->getIdteatro();
		//echo $consultaModifica;
        if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}


    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM teatro WHERE idteatro=".$this->getIdteatro();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}



    public function __toString()
    {   

       $respuesta= "\n <-<-< Id ". $this->getIdteatro()." >->->\n <-<-< Teatro ". $this->getNombre()." >->->\n Direccion: ". $this->getDireccion(). "\n\n ".$this->mostrarFunciones() ."\n";

        return  $respuesta;
    }


    public function mostrarFunciones(){

        $arreglo="";

        foreach ($this->getFunciones() as $value) {
            $arreglo.=$value."\n\n";
        }

        return $arreglo;
    }


    public function sumarCosto(){

        $arregloFunciones = $this->getFunciones();
        $totalCosto=0;

        foreach ($arregloFunciones as $objFunciones) {
            $precio_obra = $objFunciones->darCosto();
            $totalCosto = $totalCosto+ $precio_obra;
        }
        
        return "$".$totalCosto;
    }


    public function controlHorarios($objTeatro,$horaInicio,$duracionObra){
        
        $arrayFunciones = $objTeatro->getFunciones(); 

        //Datos creados
        
        $horaInicioArray = explode(":", $horaInicio);
        $hr_inicio= $horaInicioArray[0];
        $min_inicio= $horaInicioArray[1];
        
        
        $duracionObraArray = explode(":", $duracionObra);
        $hr_duracion_obra = $duracionObraArray[0];
        $min_duracion_obra = $duracionObraArray[1];

        
        
        //Transformo todo a minutos
        $total_min_inicio = $hr_inicio * 60 + $min_inicio;
        $total_min_fin =$total_min_inicio + $hr_duracion_obra * 60 + $min_duracion_obra;
        //-------------------------
        
        $horario_ocupado = false;

        //Recorro mi arreglo de funciones
        foreach ($arrayFunciones as $value) {
            //Transformo todo a minutos los datos que tengo en el arreglo
            $ht=$value->getHorario_inicio();
            $htArray=explode(":",  $ht);
            $h=$htArray[0];
            $m=$htArray[1];
            

            $htDuracionObra=$value->getDuracion_obra();
            $htArrayDuracionObra=explode(":",  $htDuracionObra);
            $hDuracionObra=$htArrayDuracionObra[0];
            $mDuracionObra=$htArrayDuracionObra[1];


            $inicio = $h*60+$m;
            $fin =$inicio + $hDuracionObra*60+$mDuracionObra;

            //comparo mis horarios ya creados en el arreglo, 
            //con los horarios del objeto a guardar en el arreglo
            
            if($total_min_inicio <= $inicio && $total_min_fin >= $fin){
                $horario_ocupado = true;
            }
            if($total_min_inicio >= $inicio && $total_min_inicio <= $fin){
                $horario_ocupado = true;
            }
            if($total_min_fin >= $inicio && $total_min_fin <= $fin){
                $horario_ocupado = true;
            }
            
        }

        return $horario_ocupado;
    }




    
}