#!/bin/bash
#Use crxbuild.php to pack a Chromium extension directory into crx and zip formats
DIR=`dirname $0`
php $DIR/crxbuild.php "$@"