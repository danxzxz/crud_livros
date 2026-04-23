<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Livro.php");
require_once(__DIR__ . "/../model/Genero.php");
require_once(__DIR__ . "/../model/Idioma.php");

class LivroDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }

   public function listar() {
  $sql = "SELECT a.*, 
            c.idioma AS idioma_idioma,
            p.genero AS genero_genero,
            a.capa AS capa
        FROM livros a
            JOIN idiomas c ON c.id = a.id_idioma
            JOIN generos p ON p.id = a.id_genero";

    $stm = $this->conexao->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll();

    return $this->map($result);
}

public function buscarPorId($id) {
    $sql = "SELECT a.*, 
                c.idioma idioma_idioma, c.idioma idioma_idioma,
                p.genero genero_genero
            FROM livros a
                JOIN idiomas c ON (c.id = a.id_idioma)
                JOIN generos p ON (p.id = a.id_genero)
            WHERE a.id = ?";
    $stm = $this->conexao->prepare($sql);
    $stm->execute([$id]);
    $result = $stm->fetchAll();

    $livros = $this->map($result);
    if(count($livros) > 0) {
        return $livros[0];
    }else {
        return NULL;
    }
}

    public function inserir(Livro $livro) {
        try {
            $sql = "INSERT INTO livros (titulo, ano_publicacao, autor, id_idioma, id_genero, capa)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$livro->getTitulo(), $livro->getAno_publicacao(), 
                        $livro->getAutor(),
                        $livro->getIdioma()->getId(),
                         $livro->getGenero()->getId(), $livro->getCapa()]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    }
    
    public function alterar(Livro $livro) {
          try {
            $sql = "UPDATE livros 
                    SET titulo = ?, ano_publicacao = ?, autor = ?, id_idioma = ?, id_genero = ?, capa = ?
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$livro->getTitulo(), $livro->getAno_publicacao(), 
                        $livro->getAutor(),
                        $livro->getIdioma()->getId(),
                        $livro->getGenero()->getId(),
                    $livro->getId(), $livro->getCapa()]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    
    }

      public function excluirPorId(int $id) {
          try {
            $sql = "DELETE FROM livros 
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$id]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    
    }

    private function map(array $result) {
        $livros = array();
        foreach($result as $r) {
            $livro = new Livro();
            $livro->setId($r["id"]);
            $livro->setTitulo($r['titulo']);
            $livro->setAno_publicacao($r["ano_publicacao"]);
            $livro->setAutor($r['autor']);
            $livro->setCapa($r['capa'] ?? null);

            
            $idioma = new Idioma();
            $idioma->setId($r["id_idioma"]);
            $idioma->setIdioma($r["idioma_idioma"]);
            $livro->setIdioma($idioma);

            $genero = new Genero(1);
            $genero->setId($r["id_genero"]);
            $genero->setGenero($r["genero_genero"]);
            $livro->setGenero($genero);

            array_push($livros, $livro);
        }
        return $livros;
    }

}