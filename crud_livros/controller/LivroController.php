<?php

require_once(__DIR__ . "/../dao/LivroDAO.php");
require_once(__DIR__ . "/../model/Livro.php");
require_once(__DIR__ . "/../service/LivroService.php");

class LivroController {

    private LivroDAO $livroDAO;
    private LivroService $livroService;

    public function __construct() {
        $this->livroDAO = new LivroDAO(); 
        $this->livroService = new LivroService();       
    }

    public function listar() {
        $lista = $this->livroDAO->listar();
        return $lista;
    }
        public function buscarPorId($id) {
        $livro = $this->livroDAO->buscarPorId($id);
        return $livro;
    }

    public function inserir(Livro $livro) {
        $erros = $this->livroService->validarLivro($livro);

        if(count($erros) > 0) {
            return $erros;
        }
        //se nao tiver erros, chama o dao
        
        $erro = $this->livroDAO->inserir($livro);
        if($erro) {
            array_push($erros, "Erro ao salvar o livro!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function Alterar(Livro $livro) {
        $erros = $this->livroService->validarLivro($livro);

        if(count($erros) > 0) 
            return $erros;
        

        //se nao tiver erros, alterar o livro no banco de dados
        $erro = $this->livroDAO->alterar($livro);
        if($erro) {
            array_push($erros, "Erro ao atualizar o livro!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }
        return $erros;

    }

    public function excluirPorId(int $id) {
        $erro = $this->livroDAO->excluirPorId($id);
        if($erro) {
            array_push($erros, "Erro ao excluir o livro!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());    
        }
        
        return $erros;
    }
}
    


