<?php

namespace App\Model;

use LogicException;

class Funcionario
{
    private ?int $id = null;

    public function __construct(
        private ?string $nome,
        private ?float $salario,
        private string $cpf
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): ?string { return $this->nome; }
    public function getSalario(): ?float { return $this->salario; }
    public function getCpf(): string { return $this->cpf; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setNome(?string $nome): self { $this->nome = $nome; return $this; }
    public function setSalario(?float $salario): self { $this->salario = $salario; return $this; }
    public function setCpf(string $cpf): self { $this->cpf = $cpf; return $this; }
}
