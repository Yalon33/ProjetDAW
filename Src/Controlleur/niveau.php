<?php
    enum Niveau {
        case Sixieme;
        case Cinquieme;
        case Quatrieme;
        case Troisieme;
        case Seconde;
        case Premiere;
        case Terminale;
        case L1;
        case L2;
        case L3;
        case M1;
        case M2;

        public static function stringToNiveau($string){
            switch($string){
                case "Sixieme":
                    return Niveau::Sixieme;
                case "Cinquieme":
                    return Niveau::Cinquieme;
                case "Quatrieme":
                    return Niveau::Quatrieme;
                case "Troisieme":
                    return Niveau::Troisieme;
                case "Seconde":
                    return Niveau::Seconde;
                case "Terminale":
                    return Niveau::Terminale;
                case "L1":
                    return Niveau::L1;
                case "L2":
                    return Niveau::L2;
                case "L3":
                    return Niveau::L3;
                case "M1":
                    return Niveau::M1;
                case "M2":
                    return Niveau::M2;
            }
        }
    }
?>