<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$applicationAspectKernel = \AZE\aop\kernel\Kernel::getInstance();
$applicationAspectKernel->init(array(
    'debug' => true,                                // Use 'false' for production mode
    'appDir' => __DIR__ . '/../private',                // Application directory
    'cacheDir' => __DIR__ . '/../cache',            // Cache directory
    'excludePaths' => array(
        __DIR__ . '/../vendor'
    )
));