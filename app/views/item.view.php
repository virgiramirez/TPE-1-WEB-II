<?php

class GardenView {
    private $user = null;

    public function __construct(){
    
    }

    public function showPlants($plants) {
        require './templates/plants.list.phtml';
    }

    public function showPlant($plant, $order){
        require 'templates/plant.detail.phtml';
    }

    public function showAddForm($orders){
        require 'templates/form.new.phtml';
    }

    public function showUpdateForm($plant, $orders){
        require 'templates/form.update.phtml';
    }

    public function showError($error){ 
        require 'templates/error.phtml';
    }
}
