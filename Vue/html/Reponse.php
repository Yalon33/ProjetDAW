<?php
class Reponse 
{
    private id;
    private reponse;

    private function __construct($id,$reponse)
    {
        $this->$id = $id;
        $this->$reponse = $reponse;
        $this->$participant=list();
    }
    public function getId()
    {
        return $this->$id;
    }
    public function setId($id)
    {
        $this->$id = $id;
    }
     public function getReponse()
    {
        return $this->$reponse;
    }
    public function setReponse($reponse)
    {
        $this->$reponse = $reponse;
    }
}


?>