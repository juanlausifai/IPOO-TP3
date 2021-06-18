<?php

class Funciones{

    private $idfunciones;
    private $objTeatro;
    private $nombre;
    private $horario_inicio;
    private $duracion_obra;
    private $precio;
    private $mensajeoperacion;
    

    /**
    * Constructor
    * @param String $nombre
    * @param Array $horario_inicio
    * @param Array $duracion_obra
    * @param String $precio
    * 
    **/

    public function __construct()
    {
        $this->idfunciones=0;
        $this->objTeatro="";
        $this->nombre="";
        $this->horario_inicio="";
        $this->duracion_obra="";
        $this->precio="";
        $this->mensajeoperacion="";

    }

    /**
     * Get the value of idfunciones
     */ 
    public function getIdfunciones()
    {
        return $this->idfunciones;
    }

    /**
     * Set the value of idfunciones
     *
     * @return  self
     */ 
    public function setIdfunciones($idfunciones)
    {
        $this->idfunciones = $idfunciones;
    }

    /**
     * Get the value of objTeatro
     */ 
    public function getObjTeatro()
    {
        return $this->objTeatro;
    }

    /**
     * Set the value of objTeatro
     */ 
    public function setObjTeatro($objTeatro)
    {
        $this->objTeatro = $objTeatro;
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
     * Get the value of horario_inicio
     */ 
    public function getHorario_inicio()
    {
        return $this->horario_inicio;
    }

    /**
     * Set the value of horario_inicio
     */ 
    public function setHorario_inicio($horario_inicio)
    {
        $this->horario_inicio = $horario_inicio;
    }

    /**
     * Get the value of duracion_obra
     */ 
    public function getDuracion_obra()
    {
        return $this->duracion_obra;
    }

    /**
     * Set the value of duracion_obra
     */ 
    public function setDuracion_obra($duracion_obra)
    {
        $this->duracion_obra = $duracion_obra;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;
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



    public function __toString()
    {
        return "id ".$this->getIdfunciones()." Nombre: ".$this->getNombre().", Hr.Inicio: ".$this->getHorario_inicio().", Duracion obra: ".$this->getDuracion_obra().", Precio: ".$this->getPrecio();
    }

    


    

    

    public function darCosto(){
        return $this->getPrecio();
    }

    public function cargar($paramFunciones){	
	    $this->setIdfunciones($paramFunciones['idfunciones']);
        $this->setObjTeatro($paramFunciones['idteatro']);
        $this->setNombre($paramFunciones['nombre']);
		$this->setHorario_inicio($paramFunciones['hora_inicio']);
		$this->setDuracion_obra($paramFunciones['duracion_obra']);
		$this->setPrecio($paramFunciones['precio']);
       
    }


    /**
	 * Recupera los datos de una funcion por ID
	 * @param int $id
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($id){
		$base=new BaseDatos();
		$consultaFunciones="Select * from funciones where idfunciones=".$id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaFunciones)){
				if($row2=$base->Registro()){
				    $this->setIdfunciones($id);
					$this->setNombre($row2['nombre']);
                    $this->setHorario_inicio($row2['horario_inicio']);
                    $this->setDuracion_obra($row2['duracion_obra']);
                    $this->setPrecio($row2['precio']);
                    $this->setObjTeatro($row2['idteatro']);
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
	    $arregloFunciones = null;
		$base=new BaseDatos();
		$consultaFunciones="Select * from funciones ";
		if ($condicion!=""){
		    $consultaFunciones=$consultaFunciones.' where '.$condicion;
		}
		$consultaFunciones.=" order by idfunciones ";
		//echo $consultaFunciones;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaFunciones)){				
				$arregloFunciones= array();
				while($row2=$base->Registro()){
				    $idfunciones=$row2['idfunciones'];
					$nombre=$row2['nombre'];
					$horaInicio=$row2['horario_inicio'];
                    $duracionObra=$row2['duracion_obra'];
                    $precio=$row2['precio'];
                    $idTeatro=$row2['idteatro'];

                    $arregloAsociativoFuncion= array(
                        'idfunciones'=>$idfunciones,
                        'idteatro'=>$idTeatro,
                        'nombre'=>$nombre,
                        'hora_inicio'=>$horaInicio,
                        'duracion_obra'=>$duracionObra,
                        'precio'=>$precio,
                    );

                    $funciones=new Funciones();
					$funciones->cargar($arregloAsociativoFuncion);
					array_push($arregloFunciones,$funciones);
				}
			
		 	}	else {
		 			//$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		//$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloFunciones;
	}


    

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO funciones(idteatro, nombre, horario_inicio,  duracion_obra, precio) 
				VALUES ('".$this->getObjTeatro()."','".$this->getNombre()."','".$this->getHorario_inicio()."','".$this->getDuracion_obra()."','".$this->getPrecio()."')";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdfunciones($id);
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
		$consultaModifica="UPDATE funciones SET idteatro='".$this->getObjTeatro()."',precio='".$this->getPrecio()."',nombre='".$this->getNombre()."'
                           ,horario_inicio='".$this->getHorario_inicio()."',duracion_obra='". $this->getDuracion_obra()."' WHERE idfunciones =".$this->getIdfunciones();
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
				$consultaBorra="DELETE FROM funciones WHERE idfunciones=".$this->getIdfunciones();
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

   
}