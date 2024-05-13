<?php

class router {
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

       var_dump($this->url_parsed);
    }
} 