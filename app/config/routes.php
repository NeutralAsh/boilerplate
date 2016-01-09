<?php

//All the routes sort by Request Method.
$routes = [
  //Index page.
  'index' => 'ExampleController@Index',
  //Routes for GET request.
  'GET' => [
    ['test', 'ExampleController@test']
  ],
  //Routes for POST request.
  'POST' => [

  ],
  //Routes for PUT request.
  'PUT' => [],
  //Routes for DELETE request.
  'DELETE' =>  [],
  //Error route :
  'error' => 'Error@error_404'
];
