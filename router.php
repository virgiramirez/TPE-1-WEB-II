<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middlewares.php';
require_once 'app/middlewares/verify.auth.middlewares.php';

require_once './app/controllers/category.controller.php';
require_once './app/views/category.view.php';
require_once './app/models/category.model.php';
require_once 'app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'list'; // accion por defecto
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}

// tabla de ruteo

// Class GardenController
    // function list
        // listar items  -> a.controller-> showPlants();
        // listar categorias -> a.controller--> showCategories();
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

$params = explode('/', $action);
switch($params[0]){
    case 'list':
        $controller = new CategoryController;
        $controller->showCategories();
        break;
    case 'category':
        if(isset($params[1])) {
            $controller = new CategoryController;
            $controller->showItemsByCategory($params[1]);
        }
        break;
    case 'addCategories':
        $controller = new CategoryController;
        $controller->addcategories();
        break;
    case 'deleteCategory':
        $controller = new CategoryController;
        $controller->deleteCategory($params[1]);
        break;
    case 'updateCategory':
            $controller = new CategoryController;
            $controller->updateCategory();
        break;
    case 'showUpdateCategory': 
        if(isset($params[1])){
            $controller = new CategoryController;
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