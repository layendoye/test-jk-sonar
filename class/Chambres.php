<?php

class Chambres {
    private $numero;
    private $id_bat;
    public function __construct($numero,Batiment $batiment){
        $this->numero=$numero;
        $this->id_bat=$batiment->getId_bat();
    }
    

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of id_bat
     */ 
    public function getId_bat()
    {
        return $this->id_bat;
    }

    /**
     * Set the value of id_bat
     *
     * @return  self
     */ 
    public function setId_bat($id_bat)
    {
        $this->id_bat = $id_bat;

        return $this;
    }
}