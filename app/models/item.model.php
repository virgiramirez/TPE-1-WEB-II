<?php
    require_once './app/models/config.php';
    
    class GardenModel {

        protected $db;

        public function __construct(){
            $this->db = new PDO(
            'mysql:host='.MYSQL_HOST.
            ';dbname='.MYSQL_DB.
            ';charset=utf8', 
            MYSQL_USER, MYSQL_PASS);
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
            $query = $this->db->prepare('SELECT * FROM planta WHERE id_planta = ?');
            $query->execute([$id]);   
        
            $plant = $query->fetch(PDO::FETCH_OBJ);
        
            return $plant;
        }

        public function insertPlant($nombre, $precio, $id_pedido, $stock) { 
            $query = $this->db->prepare('INSERT INTO planta (nombre, precio, id_pedido, stock) VALUES (?, ?, ?, ?)');
            $query->execute([$nombre, $precio, $id_pedido, $stock]);
        
            $id = $this->db->lastInsertId();
        
            return $id;
        }

        public function getOrders($id) {
            $query = $this->db->prepare('SELECT * FROM pedidos WHERE id_pedido = ?');
            $query->execute([$id]);
            
            $pedidos = $query->fetch(PDO::FETCH_OBJ);
            
            return $pedidos;
        }

        public function deletePlant($id) {
            $query = $this->db->prepare('DELETE FROM planta WHERE id_planta = ?');
            $query->execute([$id]);
        }

        public function editPlant($id, $nombre, $precio, $id_pedido, $stock) {
            $query = $this->db->prepare('UPDATE planta SET nombre = ?, precio = ?, id_pedido = ?, stock = ? WHERE id_planta = ?');
            $query->execute([$nombre, $precio, $id_pedido, $stock, $id]);
        }
    }   