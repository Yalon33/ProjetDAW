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
        
        public function setQuestion($question2)
        {
            $this->$question=$question2;
        }

        public function setReponse($reponse2)
        {
            $this->$reponse=$reponse2;
        }
    }



?>