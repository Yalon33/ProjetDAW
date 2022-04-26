<?php
    class CanalControleur extends Controleur
    {
        public function canal(Request $request)
        {
            $canal = CanalDAO::getById($request->getId());
            $arrayMessage = MessageDAO::getByCanal($canal);
            $arrayUtilisateur = [];
            foreach($arrayMessage as $m){
                $arrayUtilisateur[$m->getId()] = UtilisateurDAO::getById($m->getIdAuteur());
            }
            $param = [
                'c' => $canal,
                'm' => $arrayMessage,
                'u' => $arrayUtilisateur
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
            //header("Location: /home");
        }
    }
?>