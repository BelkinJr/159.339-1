<?php

// Fearon, 05178096 / Belkin, 17385402 - Assignment 1

namespace mfearonvbelkin\A1;

/**
 * Registers function with SPL and auto loads Classes
 *
 * @param $class (string, namespace and class name)
 */
spl_autoload_register(function ($className) {

    /**
     * Create string of Namespace
     *
     * @var string
     */
    $nameSpace = 'mfearonvbelkin\\A1\\';

    /**
     * Get the length of the nameSpace string
     *
     * @var int
     */
    $len = strlen($nameSpace);

    /**
     * Create string of base path to the required Class
     *
     * @var string
     */
    $basePath = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    /**
     * Check that the $className contains the namespace
     */
    if (strncmp($nameSpace, $className, $len) !== 0) {

      return;
    }

    /**
     * Create a string variable containing the string in $className less the part of the $ClassName string that contains the Namespace
     *
     * @var string
     */
    $classOnly = substr($className, $len);

    /**
     * The file path to the required Class is the base path, plus the className less the Namespace, plus the php file extension
     *
     * @var string
     */
    $file = $basePath . $classOnly . '.php';

    /**
     * If the file path works, then load the file
     */
    if (file_exists($file)) {
        require $file;
    }
});
