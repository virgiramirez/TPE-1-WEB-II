<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require './templates/form.login.phtml';
    }
}
