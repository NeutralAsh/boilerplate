<?php
#This config file is for defining all the URL paths

$http = !array_key_exists('HTTPS', $_SERVER) ? 'http://' : 'https://';

#Root URL
define("BASE_PATH", $http . $_SERVER['SERVER_NAME']);

#Current URL
define("CURRENT_URL", $http . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);

#Assets URL
define("ASSETS", BASE_PATH . 'public/assets/');
