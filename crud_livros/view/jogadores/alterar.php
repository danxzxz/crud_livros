<?php


require_once(__DIR__ . "/../../model/Livro.php");
require_once(__DIR__ . "/../../controller/LivroController.php");
require_once(__DIR__ . "/../../controller/GeneroController.php");
require_once(__DIR__ . "/../../controller/IdiomaController.php");


$msgErro = "";
$livro = NULL;
if (isset($_POST['titulo'])) {
    //Usuário já clicou no gravar
    $id = $_POST['id'];
    $titulo        = trim($_POST['titulo']) ? trim($_POST['titulo']) : NULL;
    $ano_publicacao       = is_numeric($_POST['ano_publicacao']) ? $_POST['ano_publicacao'] : NULL;
    $autor = trim($_POST['autor']) ? trim($_POST['autor']) : NULL;
    $idGenero = is_numeric($_POST['id_genero']) ? $_POST['id_genero'] : NULL;
    $idIdioma     = is_numeric($_POST['idioma']) ? $_POST['idioma'] : NULL;

    //Criar um objeto Livro para persistí-lo
    $livro = new Livro();
    $livro-> setId($id);
    $livro->setTitulo($titulo);
    $livro->setAno_publicacao($ano_publicacao);
    $livro->setAutor($autor);

    $idioma = new Idioma();
    $idioma->setId($idIdioma);
    $livro->setIdioma($idioma);
    //print_r($livro);

    $genero = new Genero(1);
    $genero->setId($idGenero);
    $livro->setGenero($genero);
    //Chamar o DAO para salvar o objeto Livro
    $livroCont = new LivroController();
    $erros = $livroCont->Alterar($livro);

    if(! $erros) {
        //Redirecionar para o listar
        header("location: listar.php");
    } else {
        //Converter o array de erros para string
        $msgErro = implode("<br>", $erros);
    }

} else {

    $id = 0;
    if (isset($_GET['id']))
        $id = $_GET['id'];
}
$livroCont = new LivroController();
$livro = $livroCont->buscarPorId($id);

if (! $livro) {
    //Redirecionar para o listar
    echo "ID do livro é inválido!";
    echo "<br><a href='listar.php'>Voltar</a>";
    exit;
}

include_once(__DIR__ . "/form.php");
