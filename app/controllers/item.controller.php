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

            if (!isset($_POST['id_pedido']) || empty($_POST['id_pedido'])) {
                return $this->view->showError('Falta completar el numero de pedido');
            }

            if (!isset($_POST['stock']) || empty($_POST['stock'])) {
                return $this->view->showError('Falta completar el stock de la planta');
            }

            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $pedido = $_POST['id_pedido'];
            $stock = $_POST['stock'];

            $id = $this->model->insertPlant($nombre, $precio, $pedido, $stock);

            // agrego y redirijo al home
            header('Location: '. BASE_URL  . 'plants');
        }

        public function showAddForm(){
            // obtiene los pedidos desde el modelo
            $orders = $this->model->getOrders();

            // pasa los pedidos a la vista
            $this->view->showAddForm($orders);
        }

        public function deletePlant($id) {
            // obtengo la planta por id
            $plants = $this->model->getPlant($id);
   
            if (!$plants) {
                return $this->view->showError("No existe la planta con el id=$id");
            }

            // borro la planta y redirijo
            $this->model->deletePlant($id);
            header('Location: ' . BASE_URL . 'plants');
        }

        public function showUpdateForm($id) {
            // obtengo la planta por id
            $orders = $this->model->getOrders();
            $plant = $this->model->getPlant($id);
    
            if (!$plant) {
                return $this->view->showError("No existe la planta con el id=$id");
            }
            
            // llamo a la vista para mostrar el formulario con los datos de la planta
            $this->view->showUpdateForm($plant, $orders);
            
        }
        
        public function updatePlant(){

            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                return $this->view->showError('Falta completar el nombre de la planta');
            }

            if (!isset($_POST['precio']) || empty($_POST['precio'])) {
                return $this->view->showError('Falta completar el precio de la planta');
            }

            if (!isset($_POST['id_pedido']) || empty($_POST['id_pedido'])) {
                return $this->view->showError('Falta completar el numero de pedido');
            }

            if (!isset($_POST['stock']) || empty($_POST['stock'])) {
                return $this->view->showError('Falta completar el stock de la planta');
            }

            $id = $_POST['id_planta'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $pedido = $_POST['id_pedido'];
            $stock = $_POST['stock'];

            $id = $this->model->editPlant($id, $nombre, $precio, $pedido, $stock);

            header('Location: '. BASE_URL  . 'plants');
        }
    }