<?php
    //interface IStringToType{
    //    public function toType($string) : TypeUtilisateur;
    //}
    enum TypeUtilisateur {
        case Etudiant;
        case Professeur;

        public static function toType($string){
            if ($string === "Etudiant"){
                return TypeUtilisateur::Etudiant;
            } else if ($string === "Professeur"){
                return TypeUtilisateur::Professeur;
            }
            //return $string=="Etudiant" ? TypeUtilisateur::Etudiant : TypeUtilisateur::Professeur;
        }

        public static function toString($type){
            if ($type === TypeUtilisateur::Etudiant){
                return "Etudiant";
            } else if ($type === TypeUtilisateur::Professeur){
                return "Professeur";
            }
        }
    }
?>