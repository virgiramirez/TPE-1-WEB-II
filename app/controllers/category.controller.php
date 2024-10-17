<?php
require_once './app/models/category.model.php';
require_once './app/views/category.view.php';

    class CategoryController {
        private $model; 
        private $view;

        public function __construct($res){
            $this->model = new CategoryModel();
            $this->view = new CategoryView($res->user);
        }
        public function showHome() {
            return $this->view->showHome();
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
            
            $order_date = $_POST['fecha_pedido'];
            $status = $_POST['estado'];
            $total = $_POST['total'];
            $id = $this->model->insertCategories($order_date, $status, $total);
        
            // redirijo al home
            header('Location: ' . BASE_URL);

        }

        public function deleteCategory($id){
            //obtengo la categoria por id y verifico que no tenga ningun items vinculado para eliminarlo
            
            if($this->model->getItemsByCategory($id) != null) {
                return  $this->view->showError("No se puede eliminar la categoria con el id=$id porque tiene items cargados");
           }
            $this->model->eraseCategory($id);
            
            header('Location: ' . BASE_URL);
        }
        
        public function showUpdateCategory($id) {
            $items = $this->model->getItemsByCategory($id);
            $category = $this->model->getCategory($id);
           
            if(!$category) {
                return  $this->view->showError("No existe la categoria con el id=$id");
            }
            return $this->view->renderCategory($category, $items);
            
        }
        public function updateCategory(){
            
            if(!isset($_POST['fecha_pedido']) || empty($_POST['fecha_pedido'])){
                return $this->view->showError('Falta ingresar la fecha del pedido');
            }
            if(!isset($_POST['estado']) || empty($_POST['estado'])){
                return $this->view->showError('Falta ingresar la fecha del pedido');
            }
            if(!isset($_POST['total']) || empty($_POST['total'])){
                return $this->view->showError('Falta ingresar el total');
            }
            $order_id = $_POST["id_pedido"];
            $order_date = $_POST["fecha_pedido"];
            $status = $_POST['estado'];
            $total = $_POST['total'];
            $order_id = $this->model->editCategory($order_id, $order_date, $status, $total);
            header('Location: ' . BASE_URL);
            
        }
    }   