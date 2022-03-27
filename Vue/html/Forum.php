<?php
class Forum 
{
    private $canaux;

    private function __construct($canaux)
    {
        $this->$canaux=list();
    }

    public function getCanaux()
    {
        return $this->$canaux;
    }

    public function setCanaux($canaux)
    {
        $this->$canaux=$canaux;
    }
}

?>