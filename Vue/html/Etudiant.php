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
    private $matiereSuivies = list();

    //Constructeur avec paramètres
    private function __construct($id,$login,$mdp,$mail, $niveau,  $nDossier,  $prenom, $dateNaissance, $universite, $villeEtablissement, $cycle, $anneeEtude, $bac, $anneeBac, $mentionBac, $etablissementBac, $numeroPortable, $matiereSuivies)
    {
        parent::__construct($id,$login,$mdp,$mail);
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
    //Setter de la liste

    public function getNiveau($var)
    {
        return $this->$niveau;
    }
    public function getnDossier($var)
    {
        return $this->$nDossier;
    }
    public function getPrenom($var)
    {
        return $this->$prenom;
    }
    public function getNom($var)
    {
        return $this->$nom;
    }
    public function getDateNaissance($var)
    {
       return $this->$dateNaissance;
    }
    public function getUniversite($var)
    {
        return $this->$universite;
    }
    public function getVilleEtablissement($var)
    {
        return $this->$villeEtablissement;
    }
    public function getCycle($var)
    {
        return $this->$cycle;
    }
    public function getAnneeEtude($var)
    {
        return $this->$anneeEtude;
    }
    public function getBac($var)
    {
       return $this->$bac;
    }
    public function getAnneeBac($var)
    {
       return $this->$anneeBac;
    }
    public function getMentionBac($var)
    {
        return $this->$mentionBac;
    }
    public function getEtablissementBac($var)
    {
       return $this->$etablissementBac;
    }
    public function getNumeroTelephone($var)
    {
        return $this->$numeroPortable;
    }
    //Getter Matières

    public function suivreCours($Matiere)
    {
    }

    public function ecrireMessage($string)
    {
    }

    public function modifierMessage($Matiere)
    {
    }

    public function repondreQCM($qcm)
    {
    }

}

?>
