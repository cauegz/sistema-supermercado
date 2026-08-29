<?php

namespace App\Model;

use LogicException;

class Avaliacao
{
    private ?int $id = null;

    public function __construct(
        private ?int $nota,
        private ?string $comentario,
        private int $idFuncionario,
        private ?int $idCliente = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getNota(): ?int { return $this->nota; }
    public function getComentario(): ?string { return $this->comentario; }
    public function getIdFuncionario(): int { return $this->idFuncionario; }
    public function getIdCliente(): ?int { return $this->idCliente; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setNota(?int $nota): self { $this->nota = $nota; return $this; }
    public function setComentario(?string $comentario): self { $this->comentario = $comentario; return $this; }
    public function setIdFuncionario(int $idFuncionario): self { $this->idFuncionario = $idFuncionario; return $this; }
    public function setIdCliente(?int $idCliente): self { $this->idCliente = $idCliente; return $this; }
}
