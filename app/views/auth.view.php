<?php
    class AuthView {
        private $user = null;

        public function showLogin($error = '') {
            require './templates/form.logout.phtml';
        }

    //     public function showSignup($error = '') {
    //         require 'templates/form.signup.phtml';
    //     }

        
    }