<?php

class kernel {

    private $url_parsed;

    public function __construct()
    {
        $router = new router();
        $this->url_parsed = $router->parse();
        $this->run();
    }

    private function run()
    {
        $ctrl_name = $this->url_parsed["controller"]. "Controller";
        $this->load_Controller($ctrl_name);
        $ctrl = new $ctrl_name();
        call_user_func_array(array($ctrl,$this->url_parsed['action']), $this->url_parsed['params']?$this->url_parsed['params']:array());
    } 

    private function load_controller($ctrl_name)
    {

        if(file_exists(CONTROLLERS.DS.$ctrl_name.".php")) {
            require_once(CONTROLLERS.DS.$ctrl_name.".php");
        } else {
            echo "erreur 404";
        }
    }
}