<?php
    class ForumControleur extends Controleur
    {
        public function forums()
        {
            $this->setLayout('home_layout');
            return $this->render('forums', []);
        }
  
    }
    
?>