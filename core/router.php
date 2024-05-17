<?php

class Router {

    //Traiter le cas ou il n'y pas d'action
    //Traiter le cas ou il n'y a pas de controller
    private $url;
    private $url_parsed;

    public function parse()
    {
        $this->url = $_SERVER['PATH_INFO'];
        
        $this->url = array_slice(explode("/", $this->url), 1);

        $this->url_parsed['controller'] = $this->url[0];
        $this->url_parsed['action'] = $this->url[1];

        $this->url = array_slice($this->url, 2);
        if(count($this->url) > 0) {
            $this->url_parsed['params'] = $this->url;
        } else {
            $this->url_parsed['params'][] = "";
        }


        return $this->url_parsed;
    }

}