<?php

class GardenView {
    private $user = null;

    public function __construct(){
    
    }

    public function showPlants($plants) {
        // la vista define una nueva variable con la cantida de plantas
        $count = count($plants);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/header.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}
