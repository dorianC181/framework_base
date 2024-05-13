<?php

class router {
//Traiter le cas ou il y a l'action
// Traiter le cas ou il n'y a pas d'action 

// récuperer la requete
// parser la requete et definir selon le schema suivant :
//controller/action/[param1/param2]
private $url;
private $url_parsed;


    public function parse()
    {
       $this->url = $_SERVER['PATH_INFO'];

       $this->url = array_slice(explode('/', $this->url), 1);

       $this->url_parsed['controller'] = $this->url[0];
       $this->url_parsed['action'] = $this->url[1];
       
       $this->url = array_slice($this->url, 2);


        if (count($this->url) > 0) {
              $this->url_parsed['params'] = $this->url;
        }
        else {
            $this->url_parsed['params'][] = 'index';
        }
       return $this->url_parsed;
    }
} 