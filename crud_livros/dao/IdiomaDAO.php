<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Idioma.php");

class IdiomaDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }
    
    public function listar() {
        $sql = "SELECT * FROM idiomas ORDER BY idioma";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $idiomas = $this->map($resultado);
        return $idiomas;
    }

    private function map($resultado) {
        $idiomas = array();
        foreach($resultado as $r) {
            $idioma = new Idioma();
            $idioma->setId($r['id']);
            $idioma->setIdioma($r['idioma']);

            array_push($idiomas, $idioma);
        }

        return $idiomas;        
    }

}