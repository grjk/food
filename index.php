<?php

// Start sessiom
session_start();
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

// Define another route
$f3->route('GET /lunch', function() {
    $view = new Template();
    echo $view->render('views/lunch.html');
});

// Define second route
$f3->route('GET /breakfast', function() {
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

    // Define sub route
    $f3->route('GET /breakfast/buffet', function() {
        $view = new Template();
        echo $view->render('views/breakfast-buffet.html');
    });

// Define route
$f3->route('GET /order', function() {
    $view = new Template();
    echo $view->render('views/form1.html');
});

// Define route
$f3->route('POST /order2', function() {
    // var_dump($_POST);
    $_SESSION['food'] = $_POST['food'];
    $view = new Template();
    echo $view->render('views/form2.html');
});

// Define route
$f3->route('POST /summary', function() {
    // var_dump($_POST);
    $_SESSION['selection'] = $_POST['radio'];
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Define route that accepts food parameter
$f3->route('GET /@item', function($f3, $params) {
    var_dump($params);
    $item = $params['item'];

    $foodsWeServe = array("tacos", "pizza", "bagels");
    if (!in_array($item, $foodsWeServe)) {
        echo "<p>Sorry... we don't serve $item</p>";
    }
    else {
        echo "<p>You ordered $item</p>";
    }

    switch($item) {
        case 'tacos':
            echo "<p>We serve tacos on Tuesdays</p>";
            break;
        case 'pizza':
            echo "<p>Pepporoni or veggie?</p>";
            break;
        case 'bagels':
            $f3->reroute("/breakfast");
        default:
            $f3->error(404);
    }
});

// Run Fat-Free
$f3->run();