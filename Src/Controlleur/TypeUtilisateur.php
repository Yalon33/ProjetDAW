<?php
    //interface IStringToType{
    //    public function toType($string) : TypeUtilisateur;
    //}
    enum TypeUtilisateur {
        case Etudiant;
        case Professeur;

        public static function toType($string){
            return $string=="Etudiant" ? TypeUtilisateur::Etudiant : TypeUtilisateur::Professeur;
        }
    }
?>