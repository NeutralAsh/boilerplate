<?php

class Autoloader {

  //Register a new autoloader
  public static function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  //Load the class following a pattern in the name.
  public static function autoload($class) {
    $classname = strtolower($class);

    if(preg_match('/controller/i', $class) == TRUE) {
        include 'app/controller/'.$classname.'.php';
    } elseif(preg_match('/model/i', $class)  == TRUE) {
        include 'app/model/'.$classname.'.php';
    } else {
        include 'app/system/'.$classname.'.php';
    }
  }

}
