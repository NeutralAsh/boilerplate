<?php

class ExampleController {

  public function __construct() {
    $this->Loader = new Loader();
  }

  public function Index() {
    $this->Loader->view('home');
  }

  public function test() {
    $this->Loader->view('tester');
  }

}
