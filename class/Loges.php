<?php

class Loges extends Boursiers{
    protected $id_Chambre;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='',$Libelle_categ_Bourse='',$id_Chambre=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone, $Libelle_categ_Bourse);
        $this->id_Chambre=$id_Chambre;
    }

    /**
     * Get the value of id_Chambre
     */ 
    public function getId_Chambre()
    {
        return $this->id_Chambre;
    }

    /**
     * Set the value of id_Chambre
     *
     * @return  self
     */ 
    public function setId_Chambre($id_Chambre)
    {
        $this->id_Chambre = $id_Chambre;

        return $this;
    }
}