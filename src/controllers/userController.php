<?php

#[AllowDynamicProperties]
class userController {

    public function __construct()
    {
        $this->loadModel("user");
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

    public function index($id_user)
    {
        $this->user->update(["nom"=>"CATRIC"], ["id"=>$id_user]);
    }

}