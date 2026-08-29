<?php

namespace App\Model;

use LogicException;

class ItemVenda
{
    private ?int $id = null;

    public function __construct(
        private float $precoUnitario,
        private int $quantidade,
        private int $idProduto,
        private int $idVenda
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getPrecoUnitario(): float { return $this->precoUnitario; }
    public function getQuantidade(): int { return $this->quantidade; }
    public function getIdProduto(): int { return $this->idProduto; }
    public function getIdVenda(): int { return $this->idVenda; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setPrecoUnitario(float $precoUnitario): self { $this->precoUnitario = $precoUnitario; return $this; }
    public function setQuantidade(int $quantidade): self { $this->quantidade = $quantidade; return $this; }
    public function setIdProduto(int $idProduto): self { $this->idProduto = $idProduto; return $this; }
    public function setIdVenda(int $idVenda): self { $this->idVenda = $idVenda; return $this; }
}
