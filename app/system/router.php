<?php

class Router {

  private $Loader;
  private $routes;
  private $url;
  private $match;
  private $params = [];

  public function __construct($routes, $url) {
    $this->routes = $routes;
    $this->url = $url;
    $this->Loader = new Loader();
  }

  //Manage the GET requests
  public function get($url) {
    //Get the matching URL/Action
    $route = $this->match($url, $this->routes['GET']);

    //If the URL use GET param or not
    if(count($route) == 1) {
      $callback = $this->parse($route);
    } else {
      $callback = $this->parse($route[1]);
    }

    //If the URL doesn't use GET param, load the callback without params
    //Else load the callback with the array of params.
    //And if the route action is not a Controller/Method pair, load the view.
    if(count($callback) == 2) {
      if(!isset($route[2])) {
        $ctrl = new $callback[0]();
        $ctrl->$callback[1]();
      } elseif(isset($route[2])) {
        $ctrl = new $callback[0]();
        call_user_func_array([$ctrl, $callback[1]], $this->params);
      }
    } else {
      if(!isset($route[2])) {
        $this->Loader->view($callback);
      }
    }

    //return the route so it can still be used.
    return $route;
  }

  //Manage the POST requests
  public function post($url) {

    //Get the matching URL/Action
    $route = $this->match($url, $this->routes['POST']);

    //Parse the Action
    $controller = explode('@', $route[1]);

    //If any POSTS params in the request, stock it in the $param property.
    if(!empty($_POST)) {
      foreach($_POST as $param) {
        $this->params[] = $param;
      }
    }

    //If the request doesn't use POSTS param, load the callback without params
    //Else load the callback with the array of params.
    if(!isset($route[2])) {
      $ctrl = new $controller[0]();
      $ctrl->$controller[1]();
    } elseif(isset($route[2])) {
      $ctrl = new $controller[0]();
      call_user_func_array([$ctrl, $controller[1]], $this->params);
    }

    //return the route so it can still be used.
    return $route;
  }

  //Look for a match between the URL and a route + URL params for GET request.
  private function match($url, $routes) {
    //look at the route array
    foreach($routes as $route) {
      //$basic is the expected URL
      $basic = $route[0];

      //If the URL match the URL
      if(preg_match("/^$basic/", $url)) {
          //If the route wait for params.
          if(count($route) == 3) {
            //baseUrl is the URL without any params.
            $baseUrl = '';
            //urlDetail is an array of each Url element.
            $urlDetail = explode('/', $url);
            //routeDetail is an array of each Route element (without the params)
            $routeDetail = explode('/', $route[0]);

            //sort the url (is in the basic URL or is a param)
            foreach($urlDetail as $unique) {
                if(in_array($unique, $routeDetail)) {
                    $baseUrl += $unique . '/';
                } else {
                    $this->params[] = $unique;
                }
            }

            //For the GET requests, get an error if the real number of params
            //doesn't match the expected number of params.
            if(count($this->params) != count($route[2]) && $_SERVER['REQUEST_METHOD'] == 'GET') {
              $this->Loader->view($this->routes['error']);
              die;
            }
          }
        //return the route so it can still be used.
        return $route;
      }
    }

    //if nothing match, return the index page.
    return $this->routes['index'];
  }

  private function parse($route) {
    //If the $route use the Class/Method syntax (Class@Method):
    //Return the parsed version
    //Else only return the route.
    if(preg_match('/@/', $route)) {
      return $controller = explode('@', $route);
    } else {
      return $route;
    }

  }
}
