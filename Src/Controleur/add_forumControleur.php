<?php 
    class AddForumControleur extends Controleur
    {
        public function addforum()
        {
            $this->setLayout('home_layout');
            return $this->render("addForum",[]);
        }
        public function creeforum(Request $request)
        {
            $data = $request->getData();
            $f = new Forum(null,$data["nom_form"]);
            if (!empty($data["nom_form"]))
            {
                if (ForumDAO::create($f) !== false and !empty($data["nom_form"]))
                {
                    header("Location: /addCanal/".ForumDAO::getByNom($f->getNom())->getId());
                    exit;
                }
                header("Location: /_404");
            }
            header("Location: /addForum");
        }
    } 
?>