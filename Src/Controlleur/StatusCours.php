<?php
    //interface IStringToType{
    //    public function toType($string) : TypeUtilisateur;
    //}
    enum StatusCours {
        case termine;
        case enCours;

        public static function toType($string){
            return $string=="enCours" ? TypeUtilisateur::enCours : TypeUtilisateur::termine;
        }
    }
?>