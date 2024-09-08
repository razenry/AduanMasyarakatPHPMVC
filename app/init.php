<?php

// Include necessary core files
require_once 'core/Config.php';
// require_once 'libs/Helpers.php';

// Autoload Core Libraries
spl_autoload_register(function ($class) {
    $corePath = __DIR__ . '/core/' . $class . '.php';
    $helperPath = __DIR__ . '/helpers/' . $class . '.php';

    if (file_exists($corePath)) {
        require_once $corePath;
    } elseif (file_exists($helperPath)) {
        require_once $helperPath;
    }
});

