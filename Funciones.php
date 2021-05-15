<?php

class Funciones{

    private $nombre;
    private $horario_inicio;
    private $duracion_obra;
    private $precio;

    /**
    * Constructor
    * @param String $nombre
    * @param Array $horario_inicio
    * @param Array $duracion_obra
    * @param String $precio
    * 
    **/

    public function __construct($nombre,$horario_inicio,$duracion_obra,$precio)
    {
        $this->nombre=$nombre;
        $this->horario_inicio=$horario_inicio;
        $this->duracion_obra=$duracion_obra;
        $this->precio=$precio;

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

    public function __toString()
    {
        return "Nombre: ".$this->getNombre().", Hr.Inicio: ".$this->getHorario_inicio()[0].":".$this->getHorario_inicio()[1].", Duracion obra: ".$this->getDuracion_obra()[0].":".$this->getDuracion_obra()[1].", Precio: ".$this->getPrecio();
    }

    public function controlHorarios($funciones){
        
        //Datos creados
        $hr_inicio= $this->getHorario_inicio()[0];
        $min_inicio= $this->getHorario_inicio()[1];
        $hr_duracion_obra = $this->getDuracion_obra()[0];
        $min_duracion_obra = $this->getDuracion_obra()[1];
        
        //Transformo todo a minutos
        $total_min_inicio = $hr_inicio * 60 + $min_inicio;
        $total_min_fin =$total_min_inicio + $hr_duracion_obra * 60 + $min_duracion_obra;
        //-------------------------
        
        $horario_ocupado = false;

        //Recorro mi arreglo de funciones
        foreach ($funciones as $value) {
            //Transformo todo a minutos los datos que tengo en el arreglo
            $inicio = $value->getHorario_inicio()[0]*60+$value->getHorario_inicio()[1];
            $fin =$inicio + $value->getDuracion_obra()[0]*60+$value->getDuracion_obra()[1];

            /*comparo mis horarios ya creados en el arreglo, 
            con los horarios del objeto a guardar en el arreglo*/
            
            if($inicio <= $total_min_inicio && $total_min_inicio <= $fin){
                $horario_ocupado = true;
            }
            if($inicio <= $total_min_fin && $total_min_fin <= $fin){
                $horario_ocupado = true;
            }
            
        }

        return $horario_ocupado;
    }

    

}