<?php
    enum StatusCours{
        case ENCOURS;
        case TERMINE;

        public static function toString($type){
            switch($type){
                case(StatusCours::ENCOURS):
                    return "ENCOURS";
                    break;
                case(StatusCours::TERMINE):
                    return "TERMINE";
                    break;
                default:
                    throw new Exception("Ce status de cours n'existe pas");
                    break;
            }
        }

        public static function toType($string){
            switch($string){
                case("ENCOURS"):
                    return StatusCours::ENCOURS;
                    break;
                case("TERMINE"):
                    return StatusCours::TERMINE;
                    break;
                default:
                    throw new Exception("StatusCours incorrect");
                    break;
            }
        }
    }
?>