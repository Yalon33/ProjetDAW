<?php
    //interface IStringToType{
    //    public function toType($string) : TypeUtilisateur;
    //}
    enum TypeUtilisateur {
        case ETUDIANT;
        case PROFESSEUR;

        public static function toType($string){
            if ($string === "ETUDIANT"){
                return TypeUtilisateur::ETUDIANT;
            } else if ($string === "PROFESSEUR"){
                return TypeUtilisateur::PROFESSEUR;
            } else {
                throw new Exception("TypeUtilisateur incorrect");
            }
            //return $string=="Etudiant" ? TypeUtilisateur::Etudiant : TypeUtilisateur::PROFESSEUR;
        }

        public static function toString($type){
            if ($type === TypeUtilisateur::ETUDIANT){
                return "ETUDIANT";
            } else if ($type === TypeUtilisateur::PROFESSEUR){
                return "PROFESSEUR";
            }
        }
    }
?>