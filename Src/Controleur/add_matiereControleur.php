<?php 
    class AddMatiereControleur extends Controleur
    {
        public function addmatiere()
        {
            $this->setLayout('home_layout');
            return $this->render('/addMatiere',[]);
        }
        public function creematiere(Request $request)
        {
            $data = $request->getData();
            if (!empty($data['lesson_form']) and !empty($data['image_form']))
            {
                try{
                    $m = new Matiere(null,$data['lesson_form'],date("j-n-Y"),$_SESSION["user"]->getId(),Niveau::toType($data["niveau_matiere"]),$data['image_form']);
                } catch (Exception $e){
                    header("Location: /addMatiere");
                }
                if(MatiereDAO::create($m) !== false)
                {
                    header("Location: /matieres");
                    exit;
                }
                header("Location: /matieres");
            }
        }

        public function creedocument(Request $request)
        {
            $data = $request->getData();
            if (!empty($data['titre_form']) and !empty($data['url_form']))
            {
                $c = new Contenu(null,$data['url_form']);
                if (ContenuDAO::create($c) !== false)
                {
                    if(AssociationDAO::createMatiereContenu($request->getId(),ContenuDAO::getByUri($data["url_form"])->getId()) !== false)
                    {
                        header("Location: /matieres/".$request->getId());
                        exit;
                    }
                    header("Location: /_404");
                }
            }
            header("Location: /_404");
        }
    } 
?>