<?php 
    class AddCanalControleur extends Controleur
    {
        public function addcanal(Request $request)
        {
            $this->setLayout('home_layout');
            return $this->render("addCanal",[]);
        }

        public function creecanal(Request $request)
        {
            $data = $request->getData();
            $c = new Canal(null,$data["nom_form"],$request->getId(),$_SESSION["user"]->getId());
            if (!empty($data["nom_form"]))
            {
                if (CanalDAO::create($c) !== false)
                {
                    $_SESSION["newCanal"] = true;
                    header("Location: /forum");
                    exit;
                }
                header("Location: /_404");
            }
            header("Location: /addCanal/".$request->getId());
        }
    }
?>