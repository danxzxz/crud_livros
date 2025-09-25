<?php

require_once(__DIR__ . "/../dao/IdiomaDAO.php");

class IdiomaController {

    private IdiomaDAO $idiomaDAO;

    public function __construct() {
        $this->idiomaDAO = new IdiomaDAO;
    }

    public function listar() {
        return $this->idiomaDAO->listar();
    }

    
}