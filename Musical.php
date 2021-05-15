<?php 

class Musical extends Funciones{

    private $director;
    private $cantidadPersonas;
    private $porcentajeIncremento;

    public function __construct($nombre,$horario_inicio,$duracion_obra,$precio,$director,$cantidadPersonas)
    {
        parent::__construct($nombre,$horario_inicio,$duracion_obra,$precio);
        $this->director = $director;
        $this->cantidadPersonas = $cantidadPersonas;
        $this->porcentajeIncremento = 12;
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

    /**
     * Get the value of porcentajeIncremento
     */ 
    public function getPorcentajeIncremento()
    {
        return $this->porcentajeIncremento;
    }

    /**
     * Set the value of porcentajeIncremento
     */ 
    public function setPorcentajeIncremento($porcentajeIncremento)
    {
        $this->porcentajeIncremento = $porcentajeIncremento;
    }


    public function __toString()
    {
        return parent::__toString()."\n Director: ".$this->getDirector().
        ", Cantidad de Personas".$this->getCantidadPersonas().
        ", Porcentaje de incremento: ".$this->getPorcentajeIncremento();
    }

    
}