<?php

class kernel {
    public function __construct()
    {
        $router = new router();
        $router->parse();
    }
}