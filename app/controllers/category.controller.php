<?php
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
    }   