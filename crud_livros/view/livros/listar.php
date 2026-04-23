<?php
require_once(__DIR__ . "/../../controller/LivroController.php");
include_once(__DIR__ . "../../include/header.php"); 
$livroController = new LivroController();
$lista = $livroController->listar();
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
    .table thead th {
        background-color: #e3cba6;
        color: #6c4f37;
        font-weight: bold;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f6f1e7;
    }
    .btn-primary {
        background-color: #6c4f37;
        border-color: #6c4f37;
    }
    .btn-primary:hover {
        background-color: #8d6e4a;
        border-color: #8d6e4a;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card-biblioteca">
                <div class="titulo-biblioteca text-center">
                    Listagem de Livros
                </div>
                <div>
                    <a href="inserir.php" class="btn btn-primary mb-3">Inserir</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Capa</th>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Ano Publicação</th>
                                <th>Autor</th>
                                <th>Idioma</th>
                                <th>Gênero</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($lista as $livro): ?>
                            <tr>
                                <td>
                                    <?php if ($livro->getCapa()): ?>
                                        <img src="<?= htmlspecialchars($livro->getCapa()) ?>" alt="Capa" style="width:60px;height:auto;">
                                    <?php else: ?>
                                        <span class="text-muted">Sem capa</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $livro->getId() ?></td>
                                <td><?= htmlspecialchars($livro->getTitulo()) ?></td>
                                <td><?= htmlspecialchars($livro->getAno_publicacao()) ?></td>
                                <td><?= htmlspecialchars($livro->getAutor()) ?></td>
                                <td><?= $livro->getIdioma() ? htmlspecialchars($livro->getIdioma()->getIdioma()) : '' ?></td>
                                <td><?= $livro->getGenero() ? htmlspecialchars($livro->getGenero()->getGenero()) : '' ?></td>
                                <td>
                                    <a href="alterar.php?id=<?= $livro->getId() ?>">
                                        <img src="../../img/btn_editar.png" alt="Editar">
                                    </a>
                                </td>
                                <td>
                                    <a href="excluir.php?id=<?= $livro->getId() ?>" onclick="return confirm('Confirma a exclusão?')">
                                        <img src="../../img/btn_excluir.png" alt="Excluir">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>