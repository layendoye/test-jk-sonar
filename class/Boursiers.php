<?php

class Boursiers extends Etudiants{
    protected $Libelle_categ_Bourse;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='', $Libelle_categ_Bourse=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone);
        $this->Libelle_categ_Bourse=$Libelle_categ_Bourse;
    }

    /**
     * Get the value of Libelle_categ_Bourse
     */ 
    public function getLibelle_categ_Bourse()
    {
        return $this->Libelle_categ_Bourse;
    }

    /**
     * Set the value of Libelle_categ_Bourse
     *
     * @return  self
     */ 
    public function setLibelle_categ_Bourse($Libelle_categ_Bourse)
    {
        $this->Libelle_categ_Bourse = $Libelle_categ_Bourse;

        return $this;
    }
}