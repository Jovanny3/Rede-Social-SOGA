<?php

// chamando o configure

require_once 'config/config.php';

// chamando o url 
require_once 'helpers/url.php';

// chamando o libs
spl_autoload_register(function ($files) {
    require_once 'libs/' . $files . '.php';
});

?>