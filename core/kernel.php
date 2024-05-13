<?php

class kernel {

    private $url_parsed;

    public function __construct()
    {
        $router = new router();
        $this->url_parsed = $router->parse();
    }
}