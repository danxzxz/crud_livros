<?php

require_once(__DIR__ . "/../../model/Livro.php");
require_once(__DIR__ . "/../../controller/LivroController.php");
require_once(__DIR__ . "/../../controller/IdiomaController.php");
require_once(__DIR__ . "/../../controller/GeneroController.php");

$msgErro = "";
$livro = NULL;
$autor = "";

//Receber os dados do formulário
if(isset($_POST['titulo'])) {
    //Usuário já clicou no gravar
    $titulo        = trim($_POST['titulo']) ? trim($_POST['titulo']) : NULL;
    $ano_publicacao       = is_numeric($_POST['ano_publicacao']) ? $_POST['ano_publicacao'] : NULL;
    $autor = trim($_POST['autor'] ?? '') ?: NULL;
    $idIdioma     = trim($_POST['idioma']) ? $_POST['idioma'] : NULL;
    $idGenero = trim($_POST['id_genero']) ? $_POST['id_genero'] : NULL;

    //Criar um objeto Livro para persistí-lo
    $livro = new Livro();
    $livro->setId(0);
    $livro->setTitulo($titulo);
    $livro->setAno_publicacao($ano_publicacao);
    $livro->setAutor($autor);

    $idioma = new Idioma();
    $idioma->setId($idIdioma);
    $livro->setIdioma($idioma);
    //print_r($livro);

    $genero = new Genero("");
    $genero->setId($idGenero);
    $livro->setGenero($genero);

    $generoCont = new GeneroController();
    $listaPosicoes = $generoCont->listar();

    //Chamar o DAO para salvar o objeto Livro
    $livroCont = new LivroController();
    $erros = $livroCont->inserir($livro);

    if(! $erros) {
        //Redirecionar para o listar
        header("location: listar.php");
    } else {
        //Converter o array de erros para string
        $msgErro = implode("<br>", $erros);
    }
}

include_once(__DIR__ . "/form.php");
?>