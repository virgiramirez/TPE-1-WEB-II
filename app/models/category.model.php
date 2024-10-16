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
        public function getCategory($id) {
            $query = $this->db->prepare('SELECT * FROM pedidos WHERE id_pedido = ?');
            $query->execute([$id]);
            $category = $query->fetch(PDO::FETCH_OBJ); 
            var_dump($category);
            return $category;
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
           if($this->getItemsByCategory($id) != null) {
                $queryPlant = $this->db->prepare('DELETE FROM planta  WHERE id_pedido = ?');
                $queryPlant->execute([$id]);
           }
            $query = $this->db->prepare('DELETE FROM pedidos  WHERE id_pedido = ?');
            $query->execute([$id]);
        }
        public function editCategory($id, $fecha_pedido, $estado, $total){
            $query = $this->db->prepare('UPDATE pedidos SET fecha_pedido = ?, estado = ?, total = ? WHERE id_pedido = ?');
            $query->execute([$fecha_pedido, $estado, $total, $id]);
        }
        
    }