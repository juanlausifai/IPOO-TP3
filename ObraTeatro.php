<?php

class ObraTeatro extends Funciones{

    private $porcentajeIncremento;

    public function __construct($nombre,$horario_inicio,$duracion_obra,$precio)
    {
        parent::__construct($nombre, $horario_inicio, $duracion_obra,$precio);
        $this->porcentajeIncremento = 45; 
    }

    /**
     * Get the value of porcentajeCosto
     */ 
    public function getPorcentajeIncremento()
    {
        return $this->porcentajeIncremento;
    }

    /**
     * Set the value of porcentajeCosto
     */ 
    public function setPorcentajeIncremento($porcentajeIncremento)
    {
        $this->porcentajeIncremento = $porcentajeIncremento;
    }


    public function __toString()
    {
        return parent::__toString()."\n Porcentaje de incremento: " . $this->getPorcentajeIncremento() . "%"; 
    }

}