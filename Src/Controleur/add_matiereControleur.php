<?php 
class AddMatiereControleur extends Controleur
{
    public function addmatiere()
    {
        $this->setLayout('home_layout');
        return $this->render('home');
    }
    public function creematiere(Request $request)
    {

        $data = $request->getData();
        if (!empty($data['lesson_form']) and !empty($data['image_form']))
        {
            $m = new Matiere(null,$data['lesson_form'],date("j-n-Y"),$_SESSION["user"]->getId(),Niveau::toValue($data["niveau_matiere"]),$data['image_form']);
            if(MatiereDAO::create($m) !== false)
            {
                header("Location: /home");
                exit;
            }
            header("Location: /home");
        }
       
    }

    public function creedocument(Request $request)
    {
        $data = $request->getData();
        if (!empty($data['titre_form']) and !empty($data['url_form']))
        {
            $c = new Contenu(null,$data['url_form']);
            if (ContenuDAO::create($c) != false)
            {
                if(AssociationDAO::createMatiereContenu($request->getId(),$c->getId()) != false)
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