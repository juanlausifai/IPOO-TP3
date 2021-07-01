<?php

class ObraTeatro extends Funciones{

    public function __construct()
    {
        parent::__construct();
    }

    public function cargar($paramObraTeatro){	
	    parent::cargar($paramObraTeatro);
    }

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		if(parent::insertar()){	
		    $consultaInsertar="INSERT INTO obra_teatro(idfunciones)
				VALUES (".parent::getIdfunciones().")";
			//echo $consultaInsertar;		
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
	        $consultaModifica="UPDATE obra_teatro SET idfunciones='".$this->getIdfunciones()."' WHERE idfunciones=". parent::getIdfunciones();
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
				$consultaBorra="DELETE FROM obra_teatro WHERE idfunciones=".parent::getIdfunciones();
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


    public static function listar($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from obra_teatro inner join funciones on obra_teatro.idfunciones=funciones.idfunciones";
		//$consulta="Select * from obra_teatro";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by funciones.idfunciones ";
		//echo $consulta;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new ObraTeatro();
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

    public function darCosto(){
        $precio= parent::darCosto();
        $nuevoPrecio=$precio + $precio * 45/100;
        return $nuevoPrecio;
    }

    public function __toString()
    {
        return parent::__toString()."\n Costo: " . $this->darCosto(); 
    }


	
}