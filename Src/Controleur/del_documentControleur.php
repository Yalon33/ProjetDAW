
<?php
    class DelDocumentControleur extends Controleur
    {
        public function delDocument(Request $request){
            $this->setLayout("home_layout");
            return $this->render("delDocument", ['documents' => ContenuDAO::getByMatiere(MatiereDAO::getById($request->getId()))]);
        }

        public function supprimerDocument(Request $request){
            $data = $request->getData();
            $c = ContenuDAO::getByUri($data['nom_form']);
            if($c !== false){
                ContenuDAO::delete($c);
                header("Location: /matieres/".$request->getId());
                exit;
            }
            else
            {
                $_SESSION["delDocument"] = false;
                header("Location: /delDocument/".$request->getId());
                exit;
            }
        }
    }
?>