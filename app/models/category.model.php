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

        public function insertCategories($fecha_pedido, $estado, $total) {
            $query = $this->db->prepare('INSERT INTO pedidos (fecha_pedido, estado, total) VALUES (?, ?, ?)');
            $query->execute([$fecha_pedido, $estado, $total]);

            $id = $this->db->lastInsertId();

            return $id;
        }

        public function eraseCategory($id) {
            $query = $this->db->prepare('DELETE FROM pedidos  WHERE id = ?');
            $query->execute([$id]);
        }
        
    }