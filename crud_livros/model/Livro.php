<?php

require_once(__DIR__ . "/Idioma.php");

class Livro {

    private ?int $id;
    private ?string $titulo;
    private ?int $ano_publicacao;
    private ?string $autor;
    private ?string $capa = NULL; 


    private ?Idioma $Idioma;
    private ?Genero $genero;


        public function __construct() {
        $this->genero = null;
        $this->Idioma = null;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): self
    {
        $this->genero = $genero;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAno_publicacao(): ?int
    {
        return $this->ano_publicacao;
    }

    public function setAno_publicacao(?int $ano_publicacao): self
    {
        $this->ano_publicacao = $ano_publicacao;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }


    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getIdioma(): ?Idioma
    {
        return $this->Idioma;
    }

    public function setIdioma(?Idioma $Idioma): self
    {
        $this->Idioma = $Idioma;

        return $this;
    }
    public function getCapa(): ?string
    {
        return $this->capa;
    }


    public function setCapa(?string $capa): self
    {
        $this->capa = $capa;

        return $this;
    }
}
    