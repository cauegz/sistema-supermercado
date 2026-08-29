<?php

namespace App\Model;

use DateTimeInterface;
use LogicException;

class Venda
{
    private ?int $id = null;

    public function __construct(
        private DateTimeInterface $data,
        private ?float $valor,
        private int $idFuncionario,
        private ?int $idCliente = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getData(): DateTimeInterface { return $this->data; }
    public function getValor(): ?float { return $this->valor; }
    public function getIdFuncionario(): int { return $this->idFuncionario; }
    public function getIdCliente(): ?int { return $this->idCliente; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setData(DateTimeInterface $data): self { $this->data = $data; return $this; }
    public function setValor(?float $valor): self { $this->valor = $valor; return $this; }
    public function setIdFuncionario(int $idFuncionario): self { $this->idFuncionario = $idFuncionario; return $this; }
    public function setIdCliente(?int $idCliente): self { $this->idCliente = $idCliente; return $this; }
}
