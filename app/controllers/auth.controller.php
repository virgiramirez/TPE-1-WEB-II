<?php
    require_once './app/models/user.model.php';
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
    
        public function login(){
            
            if(!isset($_POST['user']) || empty($_POST['user'])){
                return $this->view->showLogin("Falta completar el nombre de usuario");
            }
            if(!isset($_POST['password']) || empty($_POST['password'])){
                return $this->view->showLogin("Falta completar la contraseña");
            }
            
            $user = $_POST['user'];
            $password = $_POST['password'];

            // verifica que el usuario está en la base de datos
            $userFromDB = $this->model->getUser($user);

            if ($userFromDB && password_verify($password, $userFromDB->password)){
                // guardo en la sesion el id del usuario
                session_start();    
                $_SESSION['id'] = $userFromDB->id;
                $_SESSION['user'] = $userFromDB->user;
                $_SESSION['password'] = $userFromDB->password;
                
                header('Location: '. BASE_URL  . 'plants');
            }
            else {
                return $this->view->showLogin("Credenciales incorrectas");
            }
        }

        public function logout() {
            session_start(); // Va a buscar la cookie
            session_destroy(); // Borra la cookie que se buscó
            header('Location: ' . BASE_URL);
        }
    }