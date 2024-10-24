<?php
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';
require_once './app/controllers/item.controller.php';
require_once './app/controllers/category.controller.php';
require_once './app/models/item.model.php';
require_once './app/models/category.model.php';
require_once './app/views/item.view.php';
require_once './app/views/category.view.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'home'; // accion por defecto
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}
$params = explode ('/', $action);
switch($params[0]){
    case 'home':
        sessionAuthMiddleware($res); // setea $res->user si existe session
        $controller = new GardenController($res);
        $controller->showPlants();
        break;
    case 'plant':
        sessionAuthMiddleware($res);
        if (!empty($params[1])) {
            $id = $params[1];
            $controller = new GardenController($res);
            $controller->showPlant($id); 
        }
        break;
    case 'addPlant':
        $controller = new GardenController($res);
        $controller->showAddForm();
        break;
    case 'add':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // verifica que el usuario esté logueado
        $controller =  new GardenController($res);
        $controller->addPlants();
        break;
    case 'deletePlant':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); 
        if (isset($params[1])){
            $id = $params[1];
            $controller = new GardenController($res);
            $controller->deletePlant($id);
        }
    case 'updatePlant':  
        if (isset($params[1])){
            $id = $params[1];
            $controller = new GardenController($res);
            $controller->showUpdateForm($id);
        }
        break;
    case 'update':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new GardenController($res);
        $controller->updatePlant();
        break;
    case 'list':
        sessionAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->showCategories();
        break;
    case 'category':
        sessionAuthMiddleware($res);
        if(isset($params[1])) {
            $controller = new CategoryController($res);
            $controller->showItemsByCategory($params[1]);
        }
        break;
    case 'addCategories':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->addcategories();
        break;
    case 'deleteCategory':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->deleteCategory($params[1]);
        break;
    case 'updateCategory':
            $controller = new CategoryController($res);
            $controller->updateCategory();
        break;
    case 'showUpdateCategory': 
        if(isset($params[1])){
            $controller = new CategoryController($res);
            $controller->showUpdateCategory($params[1]);
        }
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
            $controller = new AuthController();
            $controller->logout();
            break;
    default: 
            echo "404 Page Not Found";
            break;  
}
