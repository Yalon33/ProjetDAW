<?php
    class DelMatiereControleur extends Controleur
    {
        public function delMatiere(){
            $this->setLayout("home_layout");
            return $this->render("delMatiere", ['matieres' => MatiereDAO::getAll()]);
        }

        public function supprimerMatiere(Request $request){
            $data = $request->getData();
            $m = MatiereDAO::getByNom($data["nom_form"]);
            if($m !== false){
                MatiereDAO::delete($m);
                header("Location: /home");
                exit;
            }
            else{
                $_SESSION["delMatiere"];
                header("Location: delMatiere");
                exit;
            }
        }
    }
?>