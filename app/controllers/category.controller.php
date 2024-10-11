<?php
require_once './app/models/category.model.php';
require_once './app/views/category.view.php';

    class CategoryController {
        private $model; 
        private $view;

        public function __construct(){
            $this->model = new CategoryModel();
            $this->view = new CategoryView();
        }
        
        public function showCategories() {
            $categories = $this->model->getCategories();

            return $this->view->showCategories($categories);
        }       
        public function showItemsByCategory($idPedido){
            $items = $this->model->getItemsByCategory($idPedido);

            return $this->view->renderItemsByCategory($items);
             
        }

        public function addCategories() {
            if(!isset($_POST['fecha_pedido']) || empty($_POST['fecha_pedido'])){
                return $this->view->showError('Falta ingresar la fecha del pedido');
            }
            if(!isset($_POST['estado']) || empty($_POST['estado'])){
                return $this->view->showError('Falta ingresar la fecha del pedido');
            }
            
            $fecha_pedido = $_POST['fecha_pedido'];
            $estado = $_POST['estado'];
            $total = $_POST['total'];
            $id = $this->model->insertCategories($fecha_pedido, $estado, $total);
        
            // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
            header('Location: ' . BASE_URL);

        }
    }   