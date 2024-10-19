<?php
    require_once 'model.php';
    require_once 'config.php';
    class CategoryModel extends Model {
        public function _deploy() {
            $query = $this->db->query('SHOW TABLES LIKE \'pedidos\'');
            $tables = $query->fetchAll();

            if(count($tables) == 0) {
                
                $orders = [
                    ['fecha_pedido' => '2024-10-17', 'estado' => 'pendiente', 'total' => 100],
                    ['fecha_pedido' => '2024-10-17', 'estado' => 'completado', 'total' => 150]
                ];
                $sql = <<<SQL
                                CREATE TABLE `pedidos` (
                    `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
                    `fecha_pedido` date NOT NULL,
                    `estado` varchar(20) NOT NULL,
                    `total` int(11) NOT NULL,
                    PRIMARY KEY (`id_pedido`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                SQL;
                $this->db->query($sql);

                $insertSql = "INSERT INTO pedidos (fecha_pedido, estado, total) VALUES (?,?,?)";
            
                $statement = $this->db->prepare($insertSql);
            
                foreach ($orders as $order){
                    $statement->execute([
                        $order['fecha_pedido'],
                        $order['estado'],
                        $order['total']
                    ]);
                }
        
            }
        }
    

        public function getCategories() {
            //Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM pedidos');
            $query->execute();
        
            //Obtengo los datos en un arreglo de objetos
            $categories = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $categories;
        }
        public function getCategory($id) {
            $query = $this->db->prepare('SELECT * FROM pedidos WHERE id_pedido = ?');
            $query->execute([$id]);
            $category = $query->fetch(PDO::FETCH_OBJ); 
            return $category;
        }
        public function getItemsByCategory($id) {
            $query = $this->db->prepare('SELECT * FROM planta WHERE id_pedido = ?');
            $query->execute([$id]);   
        
            $items = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $items;
        }

        public function insertCategories($order_date, $status, $total) {
            $query = $this->db->prepare('INSERT INTO pedidos (fecha_pedido, estado, total) VALUES (?, ?, ?)');
            $query->execute([$order_date, $status, $total]);

            $id = $this->db->lastInsertId();

            return $id;
        }

        public function eraseCategory($id) {
            $query = $this->db->prepare('DELETE FROM pedidos  WHERE id_pedido = ?');
            $query->execute([$id]);
        }
        public function editCategory($id, $order_date, $status, $total){
            $query = $this->db->prepare('UPDATE pedidos SET fecha_pedido = ?, estado = ?, total = ? WHERE id_pedido = ?');
            $query->execute([$order_date, $status, $total, $id]);
        }
        
    }