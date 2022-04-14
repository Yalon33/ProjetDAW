<?php
    class ParseDate{
        public static function fromBDD($string){
            $array = explode("-", $string);
            return "$array[2]-$array[1]-$array[0]";
        }
        public static function toBDD($string){
            $array = explode("-", $string);
            return "$array[2]-$array[1]-$array[0]";
        }
    }
?>