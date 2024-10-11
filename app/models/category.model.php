<?php

    class CategoryModel {
        private $db;

        //constructor
        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=vivero;charset=utf8', 'root', '');
        }

        public function getCategories() {
            // 2. Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM pedidos');
            $query->execute();
        
            // 3. Obtengo los datos en un arreglo de objetos
            $categories = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $categories;
        }
        public function getItemsByCategory($id) {
            $query = $this->db->prepare('SELECT * FROM planta WHERE id_pedido = ?');
            $query->execute([$id]);   
        
            $items = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $items;
        }
        
    }