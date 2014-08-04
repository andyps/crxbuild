<?php
ini_set('display_errors', 1);

if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    echo "PHP version must be at least 5.3!\n";
    exit(1);
}

if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
    error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT ^ E_NOTICE);
} else {
    error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
}

foreach (array(__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('CRXBUILD_COMPOSER_INSTALL', $file);
        break;
    }
}

if (!defined('CRXBUILD_COMPOSER_INSTALL')) {
    echo 'You need to set up the project dependencies using the following commands:' . PHP_EOL .
        'wget http://getcomposer.org/composer.phar' . PHP_EOL .
        'php composer.phar install' . PHP_EOL;
    die(1);
}

require CRXBUILD_COMPOSER_INSTALL;

if ($argc < 3) {
    echo 'Usage: php crxbuild.php --extension_dir=<extension dir> ',
         '--key_file=<private key path>',
         "\n";
    exit(1);
}

$options = array();
foreach ($argv as $arg) {
    $argParts = explode('=', $arg);
    if (count($argParts) == 2) {
        $optName = trim($argParts[0], '- ');
        $options[$optName] = trim($argParts[1]);
    }
}

try {
    $crxBuild = new CrxBuild($options);
    $crxBuild->build();
    echo "\nDone";
    echo "\n";
    exit(0);
} catch (Exception $e) {
    echo $e->getMessage();
    echo "\n";
    exit(1);
}
