<?php

class Categorie_Bourse{
    public $id_Categ_Bourse;
    public $Libelle;
    public $Montant;
    public function __construct($id_Categ_Bourse='',$Libelle='',$Montant=''){
        $this->id_Categ_Bourse=$id_Categ_Bourse;
        $this->Libelle=$Libelle;
        $this->Montant=$Montant;
    }

    /**
     * Get the value of id_Categ_Bourse
     */ 
    public function getId_Categ_Bourse()
    {
        return $this->id_Categ_Bourse;
    }

    /**
     * Set the value of id_Categ_Bourse
     *
     * @return  self
     */ 
    public function setId_Categ_Bourse($id_Categ_Bourse)
    {
        $this->id_Categ_Bourse = $id_Categ_Bourse;

        return $this;
    }

    /**
     * Get the value of Libelle
     */ 
    public function getLibelle()
    {    
        return $this->Libelle;
    }

    /**
     * Set the value of Libelle
     *
     * @return  self
     */ 
    public function setLibelle($Libelle)
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * Get the value of Montant
     */ 
    public function getMontant()
    {
        return $this->Montant;
    }

    /**
     * Set the value of Montant
     *
     * @return  self
     */ 
    public function setMontant($Montant)
    {
        $this->Montant = $Montant;

        return $this;
    }
}