<?php

require __DIR__.'/api.php';

//obtain request method
$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];


$a1 = new API( $method,  $request);
$a1->explodeRequest();


if($request == "/addQb") {
     $a1->addQuarterback();
} 
//only execute getPostRequest if an endpoint has been specified
elseif($request != "/") {
    $a1->getPostRequest();
}


    





?>