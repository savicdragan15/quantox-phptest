<?php
/*
 * entering point of application sets controller and method from GET, and the rest of the GET treats like a parmeters
 * then loads controller
 */

session_start();
error_reporting(0);

include "Loader.php";
include_once realpath("controllers/baseController.php");
include_once realpath("models/baseModel.php");

$controller = (isset($_GET['c'])) ? $_GET['c'] : "quantox";
$method = (isset($_GET['f'])) ? $_GET['f'] : "index";
$path_to_controller = realpath("controllers/" . strtolower($controller) . "Controller.php");


if (file_exists($path_to_controller))
{
    include_once $path_to_controller;

    $controller = strtolower($controller)."Controller";

    unset($_GET['c']);
    unset($_GET['f']);

    $params = $_GET;
    Loader::loadController($controller,$method,$params);
}
else
{
    echo "Requested controller does not exist.";
}

