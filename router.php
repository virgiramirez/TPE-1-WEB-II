<?php
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';
require_once './app/controllers/item.controller.php';
require_once './app/models/item.model.php';
require_once './app/views/item.view.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'plants'; // accion por defecto
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}

// tabla de ruteo

// Class GardenController
    // function list
        // listar items  -> a.controller-> showPlants();
        // listar categorias -> a.controller--> showCategory();
    // function add 
        // agregar items -> a.controller -> addPlants(); // se debe poder elegir la categoria a la que pertenecen utilizando un select
        // agregar category -> a.controller -> addCategory();
    // function delete
        // eliminar items -> a.controller -> deletePlants($id);
        // eliminar category -> a.controller -> deleteCategory();
    // function edit
        // editar items -> a.controller -> editPlants($id);
        // editar category -> a.controller -> editCategory(); 

// CLASS VIEW -> c.view.php 
// ver items/:ID -> a.controller-> viewPlants($id); 
// ver items por categoria/:ID --> a.controller--> viewCategory();

$params = explode ('/', $action);

switch($params[0]){
    case 'plants':
        sessionAuthMiddleware($res);
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
    case 'addForm':
        $controller = new GardenController($res);
        $controller->showAddForm();
        break;
    case 'addPlants':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
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
    case 'updateForm':  
        if (isset($params[1])){
            $id = $params[1];
            $controller = new GardenController($res);
            $controller->showUpdateForm($id);
        }
        break;
    case 'updatePlant':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new GardenController($res);
        $controller->updatePlant();
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
    case 'error':
        echo 'La pagina no se ve';
        break;  
}