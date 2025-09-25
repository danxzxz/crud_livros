<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Genero.php");

class GeneroDAO {
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM generos ORDER BY genero";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $generos = array();
        foreach($resultado as $r) {
            $genero = new Genero(1);
            $genero->setId($r['id']);
            $genero->setGenero($r['genero']);
            $generos[] = $genero;
        }
        return $generos;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM generos WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $r = $stm->fetch();
        if ($r) {
            $genero = new Genero(1);
            $genero->setId($r['id']);
            $genero->setGenero($r['genero']);
            return $genero;
        }
        return null;
    }

    public function inserir(Genero $genero) {
        $sql = "INSERT INTO generos (genero) VALUES (?)";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$genero->getGenero()]);
    }

    public function alterar(Genero $genero) {
        $sql = "UPDATE generos SET genero = ? WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$genero->getGenero(), $genero->getId()]);
    }

    public function excluirPorId($id) {
        $sql = "DELETE FROM generos WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$id]);
    }
}