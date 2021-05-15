<?php

class Cine extends Funciones{

    private $genero;
    private $paisOrigen;
    private $porcentajeIncremento; 

    public function __construct($nombre,$horario_inicio,$duracion_obra,$precio,$genero,$paisOrigen)
    {
      parent::__construct($nombre,$horario_inicio,$duracion_obra,$precio);
      $this->genero = $genero;
      $this->paisOrigen = $paisOrigen;
      $this->porcentajeIncremento = 65;
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
        return parent::__toString() . "\n Genero: ".$this->getGenero().
        ", Pais de origen: ".$this->getPaisOrigen().
        ", Porcentaje incremento: ".$this->getPorcentajeIncremento();
    }

}