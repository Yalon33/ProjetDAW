<?php
    
    class QCM
    {
        private $question;
        private $reponse;


        public function getQuestion()
        {
            return $this->$question;
        }

        public function getReponse()
        {
            return $this->$reponse;
        }
        
        public function setQuestion($question)
        {
            $this->$question=$question;
        }

        public function setReponse($reponse)
        {
            $this->$reponse=$reponse;
        }
    }



?>
