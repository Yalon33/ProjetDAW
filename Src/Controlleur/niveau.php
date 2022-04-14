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
    
        public static function toType($string){
            if ($string === "6EME"){
                return Niveau::SIX;
            } else if ($string === "5EME"){
                return Niveau::CINQ;
            } else if ($string === "4EME"){
                return Niveau::QUATRE;
            } else if ($string === "3EME"){
                return Niveau::TROIS;
            } else if ($string === "2ND"){
                return Niveau::SEC;
            } else if ($string === "1ERE"){
                return Niveau::PRE;
            } else if ($string === "TERM"){
                return Niveau::TERM;
            } else if ($string === "L1"){
                return Niveau::L1;
            } else if ($string === "L2"){
                return Niveau::L2;
            } else if ($string === "L3"){
                return Niveau::L3;
            } else if ($string === "M1"){
                return Niveau::M1;
            } else if ($string === "M2"){
                return Niveau::M2;
            } else {
                throw new Exception("Niveau incorrect");
            }
        }
        
        public static function toString($niv){
            if ($niv === Niveau::SIX){
               return "6EME";
            } else if ($niv === NIVEAU::CINQ){
                return "5EME";
            } else if ($niv === NIVEAU::QUATRE){
                return "4EME";
            } else if ($niv === NIVEAU::TROIS){
                return "3EME";
            } else if ($niv === NIVEAU::SEC){
                return "2ND";
            } else if ($niv === NIVEAU::PRE){
                return "1ERE";
            } else if ($niv === NIVEAU::TERM){
                return "TERM";
            } else if ($niv === NIVEAU::L1){
                return "L1";
            } else if ($niv === NIVEAU::L2){
                return "L2";
            } else if ($niv === NIVEAU::L3){
                return "L3";
            } else if ($niv === NIVEAU::M1){
                return "M1";
            } else if ($niv === NIVEAU::M2){
                return "M2";
            }
        }
    }
?>