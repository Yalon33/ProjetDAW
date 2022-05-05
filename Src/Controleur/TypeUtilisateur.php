<?php
    enum TypeUtilisateur {
        case ETUDIANT;
        case PROFESSEUR;

        public static function toString($type){
            switch ($type){
                case(TypeUtilisateur::ETUDIANT):
                    return "ETUDIANT";
                    break;
                case(TypeUtilisateur::PROFESSEUR):
                    return "PROFESSEUR";
                    break;
                default:
                    throw new Exception("Ce type d'utilisateur n'existe pas");
                    break;
            }
        }

        public static function toType($string){
            switch ($string){
                case("ETUDIANT"):
                    return TypeUtilisateur::ETUDIANT;
                    break;
                case("PROFESSEUR"):
                    return TypeUtilisateur::PROFESSEUR;
                    break;
                default:
                    throw new Exception("TypeUtilisateur incorrect");
                    break;
            }
        }

        public static function allTypeUtilisateur(){
            return array(
                TypeUtilisateur::ETUDIANT,
                TypeUtilisateur::PROFESSEUR
            );
        }
    }
?>