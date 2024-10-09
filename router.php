<?php

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'list'; // accion por defecto
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
    case 'list':

}