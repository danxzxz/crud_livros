<?php
require_once(__DIR__ . "/../../controller/GeneroController.php");
require_once(__DIR__ . "/../../controller/IdiomaController.php");

$idiomaCont = new IdiomaController();
$idiomas = $idiomaCont->listar();
//print_r($idiomas);

$generoCont = new GeneroController();
$listaPosicoes = $generoCont->listar();
include_once(__DIR__ . "/../include/header.php");
?>
<style>
    body {
        background: url('../img/biblioteca.jpg') no-repeat center center fixed;
        background-size: cover;
    }
    .card-biblioteca {
        background: rgba(255,255,255,0.95);
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        padding: 2rem;
        margin-top: 2rem;
    }
    .titulo-biblioteca {
        font-family: 'Georgia', serif;
        font-size: 2rem;
        color: #6c4f37;
        text-shadow: 1px 1px 0 #e3cba6;
        margin-bottom: 1.5rem;
    }
    .form-label {
        color: #6c4f37;
        font-weight: bold;
    }
    .btn-success {
        background-color: #6c4f37;
        border-color: #6c4f37;
    }
    .btn-success:hover {
        background-color: #8d6e4a;
        border-color: #8d6e4a;
    }
    .card-img-space {
        min-height: 300px;
        background: rgba(0,0,0,0.05);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c4f37;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-biblioteca">
                <div class="titulo-biblioteca text-center">
                    <?= $livro && $livro->getId() > 0 ? 'Alterar' : 'Inserir' ?> Livro
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="txtTitulo" class="form-label">Título:</label>
                                <input type="text" id="txtTitulo" name="titulo"
                                    placeholder="Informe o título" class="form-control"
                                    value="<?= $livro ? $livro->getTitulo() : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="txtAno_publicacao" class="form-label">Ano de publicação:</label>
                                <input type="number" id="txtAno_publicacao" name="ano_publicacao"
                                    placeholder="Informe o ano" class="form-control"
                                    value="<?= $livro ? $livro->getAno_publicacao() : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="txtAutor" class="form-label">Autor:</label>
                                <input type="text" id="txtAutor" name="autor"
                                    placeholder="Informe o nome do autor" class="form-control"
                                    value="<?= $livro ? $livro->getAutor() : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="selIdioma" class="form-label">Idioma:</label>
                                <select name="idioma" id="selIdioma" class="form-select">
                                    <option value="">----Selecione----</option>
                                    <?php foreach ($idiomas as $i): ?>
                                        <option value="<?= $i->getId() ?>"
                                            <?php if ($livro && $livro->getIdioma() && $livro->getIdioma()->getId() == $i->getId()) echo "selected"; ?>>
                                            <?= $i->getIdioma() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="selGenero" class="form-label">Gênero:</label>
                                <select name="id_genero" id="selGenero" class="form-select" required>
                                    <option value="">----Selecione----</option>
                                    <?php foreach ($listaPosicoes as $genero): ?>
                                        <option value="<?= $genero->getId() ?>"
                                            <?php if ($livro && $livro->getGenero() && $livro->getGenero()->getId() == $genero->getId())
                                                echo "selected";
                                            ?>>
                                            <?= $genero->getGenero() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" name="id"
                                value="<?= $livro ? $livro->getId() : 0 ?>">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success w-100">Gravar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="card-img-space">
<div class="mb-3">
    <label class="form-label">Capa do Livro:</label>
    <input type="file" name="capa_arquivo" class="form-control">
</div>

<!-- <div class="mb-3">
    <label class="form-label">Ou link da imagem:</label>
    <input type="text" name="capa_link" class="form-control"
        placeholder="Cole o link da capa aqui"
        value="<?= $livro ? htmlspecialchars($livro->getCapa() ?? '') : '' ?>">
</div>                             -->
                        </div>
                        <?php if ($msgErro) : ?>
                            <div class="alert alert-danger ">
                                <?= $msgErro ?>
                            </div>
                        <?php endif; ?>
                        <div class="mt-2">
                            <a href="listar.php" class="btn btn-outline-primary w-100">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>