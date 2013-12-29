<?php
namespace VideoStore;

spl_autoload_register(
    function ($class) {
        $nsLength = strlen(__NAMESPACE__);

        if (substr($class, 0, $nsLength) != __NAMESPACE__) {
            // Autoload only libraries from this package
            return;
        }

        $path = substr(str_replace('\\', '/', $class), $nsLength);
        $path = __DIR__ . $path . '.php';
        if (file_exists($path)) {
            require $path;
        }
    }
);