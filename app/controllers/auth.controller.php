<?php
 require_once './app/models/auth.model.php';
 require_once './app/views/auth.view.php';
 
 class AuthController {
     private $model;
     private $view;
 
     public function __construct() {
         $this->model = new UserModel();
         $this->view = new AuthView();
     }
     public function showLogin() {
        // Muestro el formulario de login
        return $this->view->showLogin();
    }
    public function logout() {
         session_start(); // Va a buscar la cookie
         session_destroy(); // Borra la cookie que se buscó
         header('Location: ' . BASE_URL);
    }
}
 