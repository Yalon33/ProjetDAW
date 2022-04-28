<?php
    class ForumControleur extends Controleur
    {
        public function forums()
        {
            $this->setLayout('home_layout');
            return $this->render('forums', []);
        }

        public function creeforum(Request $request)
        {
            $data = $request->getData();
            $f = new Forum(null,$data["nom_forum"]);
            if (ForumDAO::create($f) !== false)
            {
                header("Location: /forums");
                exit;
            }
            header("Location: /_404");
        }
  
    }
    
?>