<?php

//config database 
include_once "src/Config/DBConfig.php";

//config Security (jwt)
include_once "src/infra/security/TokenService.php";

//config services = models
include_once "src/Services/CategoriesServices.php";
include_once "src/Services/TaskServices.php";
include_once "src/Services/UsersServices.php";

//config controllers
include_once "src/Controllers/CategoriesControllers.php";
include_once "src/Controllers/UsersControllers.php";
include_once "src/Controllers/TaskControllers.php";

//config routes 
include_once "src/Config/RoutesDefault.php";
include_once "src/Routes/CategoriesRoutes.php";
include_once "src/Routes/UserRoutes.php";
include_once "src/Routes/TaskRoutes.php";

include_once "src/Bootstrap.php";

// config default
require_once __DIR__ ."/vendor/autoload.php";


header('Access-Control-Allow-Origin: *');
header('Content-type: Application/json'); //return body in json 

date_default_timezone_set("America/Sao_Paulo"); // date time brasilia = sp

$path = isset($_GET['path']) ? $_GET['path'] : '/';  //path of request
$requestMethod = $_SERVER['REQUEST_METHOD'];  // method in request
$postData = file_get_contents("php://input"); // acept data in format json
$post = json_decode($postData, true); // collect data in format json
$auth = $_SERVER["HTTP_AUTHORIZATION"]; // auth



$api = new Bootstrap($path, $requestMethod, $post, $auth); 

$categoriesRoutes = new CategoriesRoutes($api);

$api->load();







