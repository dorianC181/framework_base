<?php
#[AllowDynamicProperties]
class Controller {
    private $ctrl_name;
    private $vars = [];
    private $tpl = "default";

    public function __construct()
    {
        if(method_exists($this, "__init")) {
            $this->__init();
        }
        $ctrl_name = str_replace("controller", "", get_class($this));
        // $this->loadModel();
    }

    protected function loadModel($mdl_name)
    {
        $file_name = $mdl_name."Model";
        
        if(file_exists(MODELS.DS.$file_name.".php")) {
            require_once(MODELS.DS.$file_name.".php");
        } else {
            echo "Le model n'existe pas";
        }

        $this->$mdl_name = new $file_name();
    }

    protected function css ($ar) {
        foreach ($ar as $v) {
            echo '<link rel="stylesheet" href="\assets\css\\'.$v.'">';
        }
    }

    protected function script ($sc) {
        foreach ($sc as $v) {
            echo '<script src="\assets\js\\'.$v.'"></script>';
        }
    }

    protected function render ($view = null)
    {
        if (is_null($view)) { 
        $view = debug_backtrace()[1]['function'];
        }
     ob_start();
     
    extract($this->vars);
    
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

    protected function set($name, $val)
    {
        $this->vars[$name] = $val;
    }
}