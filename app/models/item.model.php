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
            // Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM planta');
            $query->execute();
        
            // Obtengo los datos en un arreglo de objetos
            $plants = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $plants;
        }

        public function getPlant($id) {    
            $query = $this->db->prepare('SELECT * FROM planta WHERE id_planta = ?');
            $query->execute([$id]);   
        
            $plant = $query->fetch(PDO::FETCH_OBJ);
        
            return $plant;
        }

        public function insertPlant($name, $price, $id, $stock) { 
            $query = $this->db->prepare('INSERT INTO planta (nombre, precio, id_pedido, stock) VALUES (?, ?, ?, ?)');
            $query->execute([$name, $price, $id, $stock]);
        
            return $id;
        }

        public function updatePlantImage($id, $image_path) {
            $query = $this->db->prepare('UPDATE planta SET imagen = ? WHERE id_planta = ?');
            $query->execute([$image_path, $id]);
        }

        public function getOrders($id = null) {
            if ($id){
                $query = $this->db->prepare('SELECT * FROM pedidos WHERE id_pedido = ?');
                $query->execute([$id]);
                $orders = $query->fetch(PDO::FETCH_OBJ);
                return $orders;
            } else {
                $query = $this->db->prepare('SELECT * FROM pedidos');
                $query->execute();
                $orders = $query->fetchAll(PDO::FETCH_OBJ);
                return $orders;
            }  
        }

        public function deletePlant($id) {
            $query = $this->db->prepare('DELETE FROM planta WHERE id_planta = ?');
            $query->execute([$id]);
        }

        public function editPlant($id, $name, $price, $order_id, $stock) {
            $query = $this->db->prepare('UPDATE planta SET nombre = ?, precio = ?, id_pedido = ?, stock = ? WHERE id_planta = ?');
            $query->execute([$name, $price, $order_id, $stock, $id]);
        }
    }   