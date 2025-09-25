<?php

require_once(__DIR__ . "/../../model/Livro.php");
require_once(__DIR__ . "/../../controller/LivroController.php");

//1- receber o id do livro(get)
$id = 0;
if (isset($_GET['id']))
    $id = $_GET['id'];  

//2- chamar o controller para excluir
$livroCont = new LivroController();
$livro = $livroCont->buscarPorId($id);  
if($livro) {
    $livroCont->excluirPorId($livro->getId());


//3- verifica se deu erro
if($erros){
    //3.1- se deu erro, exibe mensagem
    $msgErros = implode("<br>", $erros);
    // foreach($erros as $erro) {
    //     echo "<p class='alert alert-danger'>$erro</p>";
    // }
}else{
    //3.2- se nao deu erro, redireciona para a lista de livros
    header("Location: listar.php");
    exit();
}
} else {
   
    echo "<p class='alert alert-danger'>Livro não encontrado!</p>";
    echo "<p><a href='listar.php'>Voltar</a></p>";
    }