<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require("vendor/autoload.php");

// Instantiate Fat-Free
$f3 = Base::Instance();

// Define a default route (view)
$f3 -> route("GET /", function () {
     $view = new Template();
     echo $view->render("views/home.html");
});

// Define second route
$f3->route('GET /breakfast', function() {
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

// Run Fat-Free
$f3->run();