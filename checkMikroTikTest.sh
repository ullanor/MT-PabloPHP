#!/bin/bash
FILE=/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestStart.txt
FILE_TEST_START=/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestRunning.txt
FILE_TEST_FINISH=/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestFinished.txt
FILE_TEST_STOP=/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MikroTestStop.txt
PHPSCRIPT=/var/www/ullanorstart/htdocs/protectedfiles/MTphp/PABLO_MT_READY/MTPaB_servSideLoop.php

if test -f "$FILE_TEST_STOP"; then
    rm $FILE_TEST_STOP
fi
if test -f "$FILE_TEST_FINISH"; then
    echo "test was finished, removing control files" && rm $FILE_TEST_FINISH && rm $FILE_TEST_START && rm $FILE && exit 1
fi
if test -f "$FILE_TEST_START"; then
    echo "test is running" && exit 1
fi
if test -f "$FILE"; then
    echo "test was started" && date > $FILE_TEST_START && sudo php $PHPSCRIPT $(cat $FILE)
fi
















