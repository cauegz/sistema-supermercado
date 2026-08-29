<?php

namespace App\Model;

use LogicException;

class UsuarioAcesso
{
    private ?int $id = null;

    public function __construct(
        private string $email,
        private string $senha,
        private int $idFuncionario,
        private int $idPapel
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function getSenha(): string { return $this->senha; }
    public function getIdFuncionario(): int { return $this->idFuncionario; }
    public function getIdPapel(): int { return $this->idPapel; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function setSenha(string $senha): self { $this->senha = $senha; return $this; }
    public function setIdFuncionario(int $idFuncionario): self { $this->idFuncionario = $idFuncionario; return $this; }
}
