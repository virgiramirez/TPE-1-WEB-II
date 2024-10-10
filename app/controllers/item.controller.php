<?php
    require_once './app/models/item.model.php';
    require_once './app/views/item.view.php';

    class GardenController {
        private $model;
        private $view;

        public function __construct() {
        $this->model = new GardenModel();
        $this->view = new GardenView();
        }

        public function showPlants(){
            // obtengo las tareas de la base de datos
            $plants = $this->model->getPlants();

            // mando las tareas a la vista
            $this->view->showPlants($plants);
        }

        public function showPlant($id){
            // obtengo la planta por id
            $plant = $this->model->getPlant($id);

            // mando los detalles de la planta a la vista 
            if($plant) {   
                $this->view->showPlant($plant);
            }
            else{
                $this->view->showError("Error");
            }
        
        }

        public function addPlants(){
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
               return $this->view->showError('Falta completar el nombre de la planta');
            }

            if (!isset($_POST['precio']) || empty($_POST['precio'])) {
                return $this->view->showError('Falta completar el precio de la planta');
             }

             if (!isset($_POST['pedido']) || empty($_POST['pedido'])) {
                return $this->view->showError('Falta completar el numero de pedido');
             }

             if (!isset($_POST['stock']) || empty($_POST['stock'])) {
                return $this->view->showError('Falta completar el stock de la planta');
             }

            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $pedido = $_POST['pedido'];
            $stock = $_POST['stock'];

            $id = $this->model->insertPlant($nombre, $precio, $pedido, $stock);
        }

        public function deletePlants($id) {
            // obtengo la planta por id
            $plants = $this->model->getPlants($id);
    
            if (!$plants) {
                return $this->view->showError("No existe la planta con el id=$id");
            }

            // borro la planta y redirijo
            $this->model->erasePlant($id);
        }
    
    }