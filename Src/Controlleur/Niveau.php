<?php
    enum Niveau {
        case sixieme;
        case cinquieme;
        case quatrieme;
        case troisieme;
        case seconde;
        case premiere;
        case terminale;
        case l1;
        case l2;
        case l3;
        case m1;
        case m2;
    


        public static function toType($string){
            return $string=="sixieme" ? Niveau::sixieme : TypeUtilisateur::m2;
        }
    }
?>