<?php

namespace App\Model;

use LogicException;

class Cliente
{
    private ?int $id = null;

    public function __construct(
        private ?string $nome,
        private ?string $email,
        private ?string $cpf
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): ?string { return $this->nome; }
    public function getEmail(): ?string { return $this->email; }
    public function getCpf(): ?string { return $this->cpf; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setNome(?string $nome): self { $this->nome = $nome; return $this; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }
    public function setCpf(?string $cpf): self { $this->cpf = $cpf; return $this; }
}
