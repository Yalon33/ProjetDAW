<?php
    class CanalControleur extends Controleur
    {
        public function canal(Request $request)
        {
            $canal = CanalDAO::getById($request->getId());
            $param = [
                'c' => $canal,
                'm' => MessageDAO::getByCanal($canal)
            ];
            $this->setLayout('home_layout');
            return $this->render('canal', $param);
        }
    }
?>