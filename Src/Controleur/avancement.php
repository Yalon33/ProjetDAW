<?php
    enum Avancement{
        case ENCOURS;
        case TERMINE;

        public static function toString($type){
            switch($type){
                case(Avancement::ENCOURS):
                    return "EN COURS";
                    break;
                case(Avancement::TERMINE):
                    return "TERMINE";
                    break;
                default:
                    throw new Exception("Ce type d'avancement n'existe pas");
                    break;
            }
        }

        public static function toType($string){
            switch($string){
                case("EN COURS"):
                    return Avancement::ENCOURS;
                    break;
                case("TERMINE"):
                    return Avancement::TERMINE;
                    break;
                default:
                    throw new Exception("Avancement incorrect");
                    break;
            }
        }
    }
?>