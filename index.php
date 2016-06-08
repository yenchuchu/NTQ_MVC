<?php
session_start(); 
require 'Controller/UsersController.php';
require 'Controller/CategoriesController.php';
require 'Controller/ProductsController.php';


$controller = isset($_GET['controller']) ? $_GET['controller'].'Controller' : 'UsersController';
$action     = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerObj = new $controller();
$result       = $controllerObj->{$action}();

require_once 'View/Layouts/layout_default.php';
