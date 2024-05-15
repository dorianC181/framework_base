<?php
define ("ROOT", dirname(dirname(__FILE__)));
define("CORE", (dirname(__FILE__)));
define ("DS", DIRECTORY_SEPARATOR);

define("PBC", ROOT.DS."public".DS);
define("SRC", ROOT.DS."src");
define("CONTROLLERS", SRC.DS."controllers");
define("MODELS", SRC.DS."models");
define("VIEWS", SRC.DS."views");
define("TPLS", SRC.DS."templates");