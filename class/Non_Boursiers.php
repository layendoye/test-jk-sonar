<?php
class Non_Boursiers extends Etudiants{//Modifier par nonBoursiers
    protected $adresse;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='', $adresse=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone);
        $this->adresse=$adresse;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}