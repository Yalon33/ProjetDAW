<?php
    enum Niveau {
        case SIX;
        case CINQ;
        case QUATRE;
        case TROIS;
        case SEC;
        case PRE;
        case TERM;
        case L1;
        case L2;
        case L3;
        case M1;
        case M2;

        public static function toString($niv){
            switch($niv){
                case(Niveau::SIX):
                    return "6EME";
                    break;
                case(Niveau::CINQ):
                    return "5EME";
                    break;
                case(Niveau::QUATRE):
                    return "4EME";
                    break;
                case(Niveau::TROIS):
                    return "3EME";
                    break;
                case(Niveau::SEC):
                    return "2ND";
                    break;
                case(Niveau::PRE):
                    return "1ERE";
                    break;
                case(Niveau::TERM):
                    return "TERM";
                    break;
                case(Niveau::L1):
                    return "L1";
                    break;
                case(Niveau::L2):
                    return "L2";
                    break;
                case(Niveau::L3):
                    return "L3";
                    break;
                case(Niveau::M1):
                    return "M1";
                    break;
                case(Niveau::M2):
                    return "M2";
                    break;
                default:
                    throw new Exception("Ce niveau n'existe pas");
                    break;
            }
        }
    
        public static function toType($string){
            switch($string){
                case("6EME"):
                    return Niveau::SIX;
                    break;
                case("5EME"):
                    return Niveau::CINQ;
                    break;
                case("4EME"):
                    return Niveau::QUATRE;
                    break;
                case("3EME"):
                    return Niveau::TROIS;
                    break;
                case("2ND"):
                    return Niveau::SEC;
                    break;
                case("1ERE"):
                    return Niveau::PRE;
                    break;
                case("TERM"):
                    return Niveau::TERM;
                    break;
                case("L1"):
                    return Niveau::L1;
                    break;
                case("L2"):
                    return Niveau::L2;
                    break;
                case("L3"):
                    return Niveau::L3;
                    break;
                case("M1"):
                    return Niveau::M1;
                    break;
                case("M2"):
                    return Niveau::M2;
                    break;
                default:
                    throw new Exception("Niveau incorrect");
                    break;
            }
        }
    }
?>