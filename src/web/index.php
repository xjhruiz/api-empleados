<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '../../app/model/Config.php';
require_once __DIR__ . '../../app/model/Model.php';
require_once __DIR__ . '../../app/api/ApiEmployees.php';
require_once __DIR__ . '../../app/controller/Controller.php';

ini_set('display_errors', 1);
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);

$url      = strtok($_SERVER['REQUEST_URI'], '?');
$urlPath  = explode('/', $url)[1];
$response = '';
$request  = array_merge($_REQUEST, ['REQUEST_URL' => $url, 'REQUEST_URL_PATH' => $urlPath]);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($url) {
            //endpoint 3
        case '/api/addNewEmployee':
            $_POST = json_decode(file_get_contents('php://input'));
            $api = new ApiEmployees(new Model);
            $api->addNewEmployees($_POST);
            break;
        default:
            $response = "Error, the POST $url doesn't exist!";
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($url) {
        case '':
        case '/':
            $controler = new Controller(new Model);
            $controler->init();
            break;
            //endpoint 1 
        case '/api/getListEmployees';

            $api = new ApiEmployees(new Model);
            $api->getEmployees();
            break;
            //endpoint 2
        case '/api/getListEmployeesById';
            $api = new ApiEmployees(new Model);
            if (isset($request['idEmployee'])) {
                $api->getProfileEmployeeById($request['idEmployee']);
            } else {
                echo "Error, name of param is idEmployee";
            }
            break;
        case '/tableListEmployees':
            $controler = new Controller(new Model);
            $controler->showTableListEmployees();
            break;
        default:
            echo "Error, the request GET $url doesn't exist! ";
            // http_response_code(404);
            break;
    }
}



// echo $url;
