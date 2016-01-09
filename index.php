<?php
//Include Config files.
include 'app/config/routes.php';
include 'app/config/paths.php';


//Initialize Autoloader.
include 'app/system/autoloader.php';
autoloader::register();

//Initialize the router with URL and route config file.
$router = new Router($routes, $_GET['url']);

switch($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $router->get($_GET['url']);
    break;
  case 'POST':
    $router->post($_GET['url']);
    break;
  case 'PUT':
    //need to be done
    $router->put($_GET['url']);
    break;
  case 'DELETE':
    //need to be done
    $router->delete($_GET['url']);
    break;
  default:
    die('not a valid Request Method, request method =' . $_SERVER['REQUEST_METHOD']);
}
