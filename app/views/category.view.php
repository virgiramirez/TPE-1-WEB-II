<?php
    class CategoryView {
        public function showCategories($categories){

            require './templates/header.phtml';
        }

        public function renderItemsByCategory($items) {
            require './templates/items.category.phtml';
        }
        public function showError($error) {
            require 'templates/error.phtml';
        }
    
    }
