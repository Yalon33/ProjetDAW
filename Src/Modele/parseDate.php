<?php
    class ParseDate{
        public static function parse($string){
            $array = explode("-", $string);
            return !empty($array) ? "$array[2]-$array[1]-$array[0]" : throw new Exception("Le format de la date est incorrect");
        }
    }
?>