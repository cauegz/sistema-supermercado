<?php

namespace App\Model;

use LogicException;

class Fornecedor
{
    private ?int $id = null;

    public function __construct(
        private string $razaoSocial,
        private ?string $cnpj,
        private ?string $telefone,
        private ?string $email
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getRazaoSocial(): string { return $this->razaoSocial; }
    public function getCnpj(): ?string { return $this->cnpj; }
    public function getTelefone(): ?string { return $this->telefone; }
    public function getEmail(): ?string { return $this->email; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setRazaoSocial(string $razaoSocial): self { $this->razaoSocial = $razaoSocial; return $this; }
    public function setCnpj(?string $cnpj): self { $this->cnpj = $cnpj; return $this; }
    public function setTelefone(?string $telefone): self { $this->telefone = $telefone; return $this; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }
}
