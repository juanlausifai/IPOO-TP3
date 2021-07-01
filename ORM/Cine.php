<?php

class Cine extends Funciones{

    private $genero;
    private $paisOrigen;

    public function __construct()
    {
      parent::__construct();
      $this->genero = "";
      $this->paisOrigen = "";
    }

    public function cargar($paramCine){	
	    parent::cargar($paramCine);
	    $this->setGenero($paramCine['genero']);
        $this->setPaisOrigen($paramCine['paisOrigen']);
    }


    /**
     * Get the value of genero
     */ 
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     */ 
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * Get the value of paisOrigen
     */ 
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * Set the value of paisOrigen
     */ 
    public function setPaisOrigen($paisOrigen)
    {
        $this->paisOrigen = $paisOrigen;
    }



    public function darCosto(){
        $precio= parent::darCosto();
        $nuevoPrecio=$precio + $precio * 65/100;

        return $nuevoPrecio;
    }


    /**
	 * Recupera los datos de un cine por idfunciones
	 * @param int $idfunciones
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idfunciones){
		$base=new BaseDatos();
		$consulta="Select * from cine where idfunciones=".$idfunciones;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($idfunciones);
				    $this->setGenero($row2['genero']);
                    $this->setPaisOrigen($row2['paisOrigen']);
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
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from cine inner join funciones on cine.idfunciones=funciones.idfunciones";
		//$consulta="Select * from cine";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by funciones.idfunciones ";
		//echo $consulta;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Cine();
					$obj->Buscar($row2['idfunciones']);
					array_push($arreglo,$obj);
				}
		 	}	else {
		 			//$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		//$this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}	


    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		if(parent::insertar()){
		$consultaInsertar="INSERT INTO cine(idfunciones,genero, paisOrigen)
			VALUES (".parent::getIdfunciones().",'".$this->getGenero()."','".$this->getPaisOrigen()."')";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaInsertar)){
				$resp=  true;
			}	else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		} 
		return $resp;
	}


    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica="UPDATE cine SET genero='".$this->getGenero()."', paisOrigen='".$this->getPaisOrigen()."' WHERE idfunciones=". parent::getIdfunciones();
	        if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp=  true;
	            }else{
	                $this->setmensajeoperacion($base->getError());
	                
	            }
	        }else{
	            $this->setmensajeoperacion($base->getError());
	            
	        }
	    }
		
		return $resp;
	}


    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM cine WHERE idfunciones=".parent::getIdfunciones();
				if($base->Ejecutar($consultaBorra)){
				    if(parent::eliminar()){
				        $resp=  true;
				    }
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
        return parent::__toString() . "\n Genero: ".$this->getGenero().
        ", Pais de origen: ".$this->getPaisOrigen().
		", Costo: ".$this->darCosto();
    }

}