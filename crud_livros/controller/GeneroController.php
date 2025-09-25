<?php

require_once(__DIR__ . "/../dao/GeneroDAO.php");
require_once(__DIR__ . "/../model/Genero.php");

class GeneroController {

    private GeneroDAO $generoDAO;

    public function __construct() {
        $this->generoDAO = new GeneroDAO();
    }

    public function listar() {
        return $this->generoDAO->listar();
    }

    public function buscarPorId($id) {
        return $this->generoDAO->buscarPorId($id);
    }
}