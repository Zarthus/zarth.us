#!/bin/bash

mv ./travis/config.default.php ./zarth.us/includes/php/config.php
mv ./travis/zarth.us.php ./zarth.us/zarth.us.php

EXIT_CODE=php ./zarth.us/zarth.us.php

if [ "$EXIT_CODE" != 0 ]; then 
	exit 1
fi

exit 0 # No PHP errors occured.