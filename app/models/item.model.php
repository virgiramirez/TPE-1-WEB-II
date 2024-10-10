<?php

    class GardenModel {

        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=vivero;charset=utf8', 'root', '');
        }
        
        public function getPlants() {
            // 2. Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM planta');
            $query->execute();
        
            // 3. Obtengo los datos en un arreglo de objetos
            $plants = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $plants;
        }

        public function getPlant($id) {    
            $query = $this->db->prepare('SELECT * FROM planta WHERE id = ?');
            $query->execute([$id]);   
        
            $plants = $query->fetch(PDO::FETCH_OBJ);
        
            return $plants;
        }

        public function insertPlant($nombre, $precio, $pedido, $stock = false) { 
            $query = $this->db->prepare('INSERT INTO planta (nombre, precio, id_pedido, stock) VALUES (?, ?, ?, ?)');
            $query->execute([$nombre, $precio, $pedido, $stock]);
        
            $id = $this->db->lastInsertId();
        
            return $id;
        }

        public function erasePlant($id) {
            $query = $this->db->prepare('DELETE FROM planta  WHERE id = ?');
            $query->execute([$id]);
        }
    }