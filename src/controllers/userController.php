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

    private function loadModel($mdl_name)
    {
        $file_name = $mdl_name."Model";
        
        if(file_exists(MODELS.DS.$file_name.".php")) {
            require_once(MODELS.DS.$file_name.".php");
        } else {
            echo "Le model n'existe pas";
        }

        $this->$mdl_name = new $file_name();
    }

    private function render($view)
    {
<<<<<<< Updated upstream
        $this->user->insert([
            "nom"=>"Plateau",
            "prenom"=>"Leo",
            "email"=>"leo.platau@estiam.com"
        ]);
    }
}


//        $this->user->find(["id"=>$id_user, "nom"=>"CATRIC"]);
=======
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
    

    public function index()
    {
        $this->set("title", "User Index");
        $this->set("users", $this->user->findAll());
        $this->render("index");
    }

}
>>>>>>> Stashed changes
