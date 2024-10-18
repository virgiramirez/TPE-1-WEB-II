<?php

    class CategoryView {
        private $usuario = null;

        public function __construct($usuario) {
            $this->usuario = $usuario;
        }

        public function showHome(){
            require 'templates/home.phtml';
        }
        public function showCategories($categories){

            require 'templates/list.category.phtml';
        }

        public function renderItemsByCategory($items) {
            require './templates/items.category.phtml';
        }
        public function renderCategory($category, $items){
            require './templates/form.updateCategory.phtml';
        }
        public function showError($error) {
            require 'templates/error.phtml';
        }
    
    }
