<?php 
class AddCanalControleur extends Controleur
{
    public function addcanal(Request $request)
    {   
        $f = ForumDAO::getById($request->getId());
        $params =[
            "f" => $f->getNom(),
        ];
        $this->setLayout('home_layout');
        return $this->render("addCanal",$params);
    }

        public function creecanal(Request $request)
        {
            $data = $request->getData();
            $c = new Canal(null,$data["nom_form"],$request->getId(),$_SESSION["user"]->getId());
            if (!empty($data["nom_form"]) and CanalDAO::create($c) !== false)
            {
                $_SESSION["newCanal"] = true;
                header("Location: /forum");
                exit;
            }
            $_SESSION["newCanal"] = false;
            header("Location: /addCanal/".$request->getId());
        }
    }
?>