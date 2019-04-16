#!/bin/bash

#mkdir ../public/swagger
../vendor/bin/swagger --bootstrap ./swagger-constants.php --output ../public/swagger ./swagger-v1.php ./tags.php ./security.php ../app/Http/Controllers
