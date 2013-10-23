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

if ($argc < 3) {
    echo 'Usage: php crxbuild.php --extension_dir=<extension dir> ',
        '--key_file=<private key path>';
    exit(1);
}

require __DIR__ . '/../lib/CrxBuild.php';

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
