<?php 
class QCMControleur extends Controleur
{
    public function qcm()
    {
        $this->setLayout('home_layout');
        return $this->render('/qcm',[]);
    }

} 



?>