CRX builder
========

Build chromium extensions

Requirements
===================

* PHP version must be at least 5.3
* zlib extension
* openssl extension

How to make crx extension
===================

1) Command line

    $ php crxbuild.php --extension_dir=<extension dir> --key_file=<private key path> --output_dir=<output dir>
    
output_dir is an optional. It is your current directory by default.
You may also use crxbuild.sh (Linux) and crxbuild.bat (Windows), so it'll look like

    $ ./crxbuild.sh --extension_dir=<extension dir> --key_file=<private key path>
    
2) PHP

    <?php
    require $pathToCrxBuildDirectory . '/lib/CrxBuild.php';
    $crxBuild = new CrxBuild(array(
      'extension_dir' => $extensionDirectory,
      'key_file' => $pathToYourPrivateKey,
      'output_dir' => $whereToPlaceZipAndExtensionCrxFiles //optional
    ));
    $crxBuild->build();
    

-
