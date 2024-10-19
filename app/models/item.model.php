<?php
    require_once 'model.php';
    require_once 'config.php';
    
    class GardenModel extends Model {

        public function _deploy() {
            $query = $this->db->query('SHOW TABLES LIKE \'planta\'');
            $tables = $query->fetchAll();

            if(count($tables) == 0) {
                $plants = [
                    ['nombre' => 'Calathea', 'precio' => 100, 'stock' => 2],
                    ['nombre' => 'Menta', 'precio' => 50, 'stock' => 1]
                ];
                $sql = <<<SQL
                                CREATE TABLE `planta` (
                            `id_planta` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(20) NOT NULL,
                            `precio` int(11) NOT NULL,
                            `id_pedido` int(11) NOT NULL,
                            `stock` int(11) NOT NULL,
                            `imagen` varchar(150) NOT NULL,
                            PRIMARY KEY (`id_planta`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                SQL;
                $this->db->query($sql);

                $insertSql = "INSERT INTO planta (nombre, precio, stock) VALUES (?,?,?)";
            
                $statement = $this->db->prepare($insertSql);
            
                foreach ($plants as $plant){
                    $statement->execute([
                        $plant['nombre'],
                        $plant['precio'],
                        $plant['stock']
                    ]);
                }
        
            }
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
        
            return $this->db->lastInsertId();
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