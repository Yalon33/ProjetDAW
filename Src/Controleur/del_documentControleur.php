
<?php
    class DelDocumentControleur extends Controleur
    {
        public function delDocument(Request $request){
            $this->setLayout("home_layout");
            $d = ContenuDAO::getByMatiere(MatiereDAO::getById($request->getId()));
            $matiere = MatiereDAO::getById($request->getId());
            $createur = UtilisateurDAO::getById($matiere->getIdCreateur());
            return $this->render("delDocument", ['documents' => $d,"matiere" => $matiere,"createur" => $createur]);
        }

        public function supprimerDocument(Request $request){
            $data = $request->getData();
            $c = ContenuDAO::getByUri($data['nom_document']);
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