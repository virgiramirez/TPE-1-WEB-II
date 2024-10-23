<?php
    require_once './app/models/item.model.php';
    require_once './app/views/item.view.php';

    class GardenController {
        public $model;
        private $view;

        public function __construct() {
            $this->model = new GardenModel();
            $this->view = new GardenView();
        }

        public function showPlants(){
            // obtengo las plantas de la base de datos
            $plants = $this->model->getPlants();

            // mando las plantas a la vista
            $this->view->showPlants($plants);
        }

        public function showPlant($id){
            // obtengo la planta por id
            $plant = $this->model->getPlant($id);

            if($plant) {  
                $orders = $this->model->getOrders($plant->id_pedido); // obtengo el pedido asociado
                $this->view->showPlant($plant, $orders);
            }
            else {
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
            if (!isset($_FILES['imagen'])) {
                return $this->view->showError('Falta cargar la imagen');
            }

            $name = $_POST['nombre'];
            $price = $_POST['precio'];
            $order = $_POST['id_pedido'];
            $stock = $_POST['stock'];

            $id_planta = $this->model->insertPlant($name, $price, $order, $stock);
            
            $image = $_FILES['imagen'];

            if ($image['error'] === UPLOAD_ERR_OK) { // Valor: 0; No hay error, fichero subido con éxito.
                // Definir el directorio donde se guardarán las imágenes
                $image_dir = "./uploads/images/";

                $extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Obtener la extensión original
                $image_name = "planta_" . $id_planta . "." . $extension; // Crear nombre basado en id_planta
                $image_file = $image_dir . $image_name;

                move_uploaded_file($image['tmp_name'], $image_file);

                // Actualizar la planta con la ruta de la imagen
                $this->model->updatePlantImage($id_planta, $image_file);

                // redirijo al home
                header('Location: '. BASE_URL  . 'home');
            }
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
            header('Location: ' . BASE_URL . 'home');
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
            $name = $_POST['nombre'];
            $price = $_POST['precio'];
            $order = $_POST['id_pedido'];
            $stock = $_POST['stock'];

            $id = $this->model->editPlant($id, $name, $price, $order, $stock);

            header('Location: '. BASE_URL  . 'home');
        }
    }