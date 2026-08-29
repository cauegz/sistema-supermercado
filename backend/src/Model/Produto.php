<?php

namespace App\Model;

use LogicException;

class Produto
{
    private ?int $id = null;

    public function __construct(
        private string $nome,
        private float $preco,
        private ?string $descricao,
        private ?string $codigoBarras,
        private float $estoqueMinimo,
        private int $idMarca,
        private int $idCategoria
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getPreco(): float { return $this->preco; }
    public function getDescricao(): ?string { return $this->descricao; }
    public function getCodigoBarras(): ?string { return $this->codigoBarras; }
    public function getEstoqueMinimo(): float { return $this->estoqueMinimo; }
    public function getIdMarca(): int { return $this->idMarca; }
    public function getIdCategoria(): int { return $this->idCategoria; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setNome(string $nome): self { $this->nome = $nome; return $this; }
    public function setPreco(float $preco): self { $this->preco = $preco; return $this; }
    public function setDescricao(?string $descricao): self { $this->descricao = $descricao; return $this; }
    public function setCodigoBarras(?string $codigoBarras): self { $this->codigoBarras = $codigoBarras; return $this; }
    public function setEstoqueMinimo(float $estoqueMinimo): self { $this->estoqueMinimo = $estoqueMinimo; return $this; }
    public function setIdMarca(int $idMarca): self { $this->idMarca = $idMarca; return $this; }
    public function setIdCategoria(int $idCategoria): self { $this->idCategoria = $idCategoria; return $this; }
}
