<?php

class Batiment {
    private $nomBatiment;
    private $id_bat;
    public function __construct($id_bat,$nomBatiment){
        $this->nomBatiment=$nomBatiment;
        $this->id_bat=$id_bat;
    }

    /**
     * Get the value of nomBatiment
     */ 
    public function getNomBatiment()
    {
        return $this->nomBatiment;
    }

    /**
     * Set the value of nomBatiment
     *
     * @return  self
     */ 
    public function setNomBatiment($nomBatiment)
    {
        $this->nomBatiment = $nomBatiment;

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