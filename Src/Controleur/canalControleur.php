<?php
    class CanalControleur extends Controleur
    {
        public function canal(Request $request)
        {
            $canal = CanalDAO::getById($request->getId());
            $arrayMessage = MessageDAO::getByCanal($canal);
            $f = ForumDAO::getById($canal->getIdForum());
            if($arrayMessage != false)
            {
                $arrayUtilisateur = [];
                foreach($arrayMessage as $m)
                {
                    $arrayUtilisateur[$m->getId()] = UtilisateurDAO::getById($m->getIdAuteur());
                }
            }
            else
            {
                $arrayMessage = [];
                $arrayUtilisateur = [];
            }
            $param = [
                'c' => $canal,
                'm' => $arrayMessage,
                'u' => $arrayUtilisateur,
                'f' => $f,
            ];
            $this->setLayout('home_layout');
            return $this->render('canal', $param);
        }

        public function envoiMessage(Request $request)
        {
            $data = $request->getData();
            $message = new Message(null, $data['message'], $request->getId(), $_SESSION['user']->getId());
            MessageDAO::create($message);
            header("Location: /canal/".$request->getId());
            exit;
        }
    }
?>