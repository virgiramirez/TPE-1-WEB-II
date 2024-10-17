<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id'])){
            $res->usuario = new stdClass();
            $res->usuario->id = $_SESSION['id'];
            $res->usuario->user = $_SESSION['user'];
            return;
        }
    }
?>
