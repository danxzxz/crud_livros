<?php

require_once(__DIR__ . "/../model/Livro.php");

class LivroService{

    public function validarLivro(Livro $livro){

            $erros = [];    

            if(! $livro->getTitulo()){
                array_push($erros, "informe o Titulo do livro");
            }
            if(! $livro->getAno_publicacao()){
                array_push($erros, "informe o ano de publicacao do livro");
            }
            if(! $livro->getAutor()){
                array_push($erros, "informe o autor do livro");
            }

            if(! $livro->getIdioma()->getId()){
                array_push($erros, "informe o idioma do livro");
            } 


            return $erros;

    }
}
