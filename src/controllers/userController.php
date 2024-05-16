<?php

#[AllowDynamicProperties]
class userController {

    private $vars;
    private $tpl = "default";
    private $sc;

    public function __construct()
    {
        $this->loadModel("user");
    }

    
    private function css ($ar) {
        foreach ($ar as $v) {
            echo '<link rel="stylesheet" href="\assets\css\\'.$v.'">';
        }
    }

    private function script ($sc) {
        foreach ($sc as $v) {
            echo '<script src="\assets\js\\'.$v.'"></script>';
        }
    }

    private function render($view)
    {
        ob_start();
        extract ($this->vars);
        if(file_exists(VIEWS.DS.$view.".php")) {
            require_once(VIEWS.DS.$view.".php");
        } else {
            echo "La view n'existe pas";
        }
        $content_for_layout = ob_get_contents();
        ob_end_clean();

        if(file_exists(TPLS.DS.$this->tpl.".php")) {
            require_once(TPLS.DS.$this->tpl.".php");
        } else {
            echo "Le model n'existe pas";
        }
    }

    private function set($name, $val)
    {
        $this->vars[$name] = $val;
    }

    public function insert () {
        {
            $data = [
                "nom" => "Catric",
                "prenom" => "Dorian",
                "email" => "test",
                "password" => "test"
            ];
            $this->user->insert($data);
        }
    }

    public function update () {
        {
            $data = [
                "nom" => "Jea",
                "prenom" => "Michel",
                "email" => "test",
                "password" => "test"
            ];
            $this->user->update($data);
        }
    }

    public function delete($id) {
            $data = [
                "id" => $id
            ];
            
            $this->user->delete($data);
    }

<<<<<<< Updated upstream
    public function index()
    {
        $this->set("title", "User Index");
        $this->set("users", $this->user->findAll());
        $this->render("index");
=======
    public function index($id_role)
    {   

        $this->user->findAll();
>>>>>>> Stashed changes
    }

}