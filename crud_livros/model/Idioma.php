<?php

class Idioma {

    private ?int $id;
    private ?string $idioma;
 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(?string $idioma): self
    {
        $this->idioma = $idioma;

        return $this;
    }

   
}