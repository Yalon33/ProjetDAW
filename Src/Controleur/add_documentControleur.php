<?php 
class AddDocumentControleur extends Controleur
{
    public function adddocument(Request $request)
    {
        $this->setLayout('home_layout');
        return $this->render("addDocument",["error" => false]);
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
                    $_SESSION["newDocument"] = true;
                    header("Location: /matieres/".$request->getId());
                    exit;
                }
            }
        }
        $_SESSION["newDocument"] = false;
        header("Location: /addDocument/".$request->getId());
        exit;
    }

} 



?>