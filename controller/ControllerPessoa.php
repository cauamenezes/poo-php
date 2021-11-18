<?php

class ControllerPessoa {

    private $_method;
    private $_modelPessoa;

    public function __construct($model) {
        
        $this->_modelPessoa = $model;
        $this->_method = $_SERVER['REQUEST_METHOD'];

    }

    function router() {

        switch ($this->_method) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }

}

?>