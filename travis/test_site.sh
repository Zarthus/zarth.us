#!/bin/bash

mv config.default.php ../zarth.us/includes/php/config.php
mv test_zarth.us.php ../zarth.us/test_zarth.us.php

EXIT_CODE=php ../zarth.us/test_zarth.us.php

if [ "$EXIT_CODE" != 0 ]; then 
	exit 1
fi

exit 0 # No PHP errors occured.