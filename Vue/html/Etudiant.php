<?php
include("Utilisateur.php");

class Etudiant
{
    private $niveau;
    private $nDossier;
    private $prenom;
    private $nom;
    private $dateNaissance;
    private $universite;
    private $villeEtablissement;
    private $cycle;
    private $anneeEtude;
    private $bac;
    private $anneeBac;
    private $mentionBac;
    private $etablissementBac;
    private $numeroPortable;
    //liste
    private $matiereSuivies;

    //Constructeur avec paramètres
    private function __construct($id2,$login2,$mdp2,$mail2, $niveau,  $nDossier,  $prenom, $dateNaissance, $universite, $villeEtablissement, $cycle, $anneeEtude, $bac, $anneeBac, $mentionBac, $etablissementBac, $numeroPortable, $matiereSuivies)
    {
        parent::__construct($id2,$login2,$mdp2,$mail2);
        $this->$niveau = $niveau;
        $this->$nDossier = $nDossier;
        $this->$prenom = $prenom;
        $this->$nom = $nom;
        $this->$dateNaissance = $dateNaissance;
        $this->$universite = $universite;
        $this->$villeEtablissement = $villeEtablissement;
        $this->$cycle = $cycle;
        $this->$anneeEtude = $anneeEtude;
        $this->$bac = $bac;
        $this->$anneeBac = $anneeBac;
        $this->$mentionBac = $mentionBac;
        $this->$etablissementBac = $etablissementBac;
        $this->$numeroPortable = $numeroPortable;
    }
    //Setter
    public function setNiveau($var)
    {
        $this->$niveau = $var;
    }
    public function setnDossier($var)
    {
        $this->$nDossier = $var;
    }
    public function setPrenom($var)
    {
        $this->$prenom = $var;
    }
    public function setNom($var)
    {
        $this->$nom = $var;
    }
    public function setDateNaissance($var)
    {
        $this->$dateNaissance = $var;
    }
    public function setUniversite($var)
    {
        $this->$universite = $var;
    }
    public function setVilleEtablissement($var)
    {
        $this->$villeEtablissement = $var;
    }
    public function setCycle($var)
    {
        $this->$cycle = $var;
    }
    public function setAnneeEtude($var)
    {
        $this->$anneeEtude = $var;
    }
    public function setBac($var)
    {
        $this->$bac = $var;
    }
    public function setBac($var)
    {
        $this->$bac = $var;
    }
    public function setAnneeBac($var)
    {
        $this->$anneeBac = $var;
    }
    public function setMentionBac($var)
    {
        $this->$mentionBac = $var;
    }
    public function setEtablissementBac($var)
    {
        $this->$etablissementBac = $var;
    }
    public function setNumeroTelephone($var)
    {
        $this->$numeroPortable = $var;
    }

}

?>