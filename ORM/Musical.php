<?php 

class Musical extends Funciones{

    private $director;
    private $cantidadPersonas;

    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantidadPersonas = "";
    }

    public function cargar($paramMusical){	
	    parent::cargar($paramMusical);
	    $this->setDirector($paramMusical['director']);
        $this->setCantidadPersonas($paramMusical['cantidadPersonas']);
    }

    /**
     * Get the value of director
     */ 
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set the value of director
     */ 
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * Get the value of cantidadPersonas
     */ 
    public function getCantidadPersonas()
    {
        return $this->cantidadPersonas;
    }

    /**
     * Set the value of cantidadPersonas
     */ 
    public function setCantidadPersonas($cantidadPersonas)
    {
        $this->cantidadPersonas = $cantidadPersonas;
    }

    

	public function darCosto(){
        $precio= parent::darCosto();
        $nuevoPrecio=$precio + $precio * 12/100;

        return $nuevoPrecio;
    }

    	/**
	 * Recupera los datos de un musical por idfunciones
	 * @param int $idfunciones
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idfunciones){
		$base=new BaseDatos();
		$consulta="Select * from musicales where idfunciones=".$idfunciones;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($idfunciones);
				    $this->setDirector($row2['director']);
                    $this->setCantidadPersonas($row2['cantidadPersonas']);
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
		$consulta="Select * from musicales inner join funciones on musicales.idfunciones=funciones.idfunciones";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		//$consulta.=" order by idfunciones ";
		//echo $consulta;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Musical();
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
		    $consultaInsertar="INSERT INTO musicales(idfunciones,director, cantidadPersonas)
				VALUES (".parent::getIdfunciones().",'".$this->getDirector()."','".$this->getCantidadPersonas()."')";
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
	        $consultaModifica="UPDATE musicales SET cantidadPersonas='".$this->getCantidadPersonas()."', director='".$this->getDirector()."' WHERE idfunciones=". parent::getIdfunciones();
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
				$consultaBorra="DELETE FROM musicales WHERE idfunciones=".parent::getIdfunciones();
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
        return parent::__toString()."\n Director: ".$this->getDirector().
        ", Cantidad de Personas: ".$this->getCantidadPersonas().
		", Costo: ".$this->darCosto();
    }


	

    
}