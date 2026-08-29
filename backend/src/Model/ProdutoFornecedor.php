<?php

namespace App\Model;

use LogicException;

class ProdutoFornecedor
{
    private ?int $id = null;

    public function __construct(
        private ?string $codigoFornecedor,
        private ?float $ultimoCusto,
        private int $idFornecedor,
        private int $idProduto
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getCodigoFornecedor(): ?string { return $this->codigoFornecedor; }
    public function getUltimoCusto(): ?float { return $this->ultimoCusto; }
    public function getIdFornecedor(): int { return $this->idFornecedor; }
    public function getIdProduto(): int { return $this->idProduto; }

    public function setId(int $id): self
    {
        if ($this->id !== null) throw new LogicException("O id ja existe");
        $this->id = $id;
        return $this;
    }

    public function setCodigoFornecedor(?string $codigoFornecedor): self { $this->codigoFornecedor = $codigoFornecedor; return $this; }
    public function setUltimoCusto(?float $ultimoCusto): self { $this->ultimoCusto = $ultimoCusto; return $this; }
    public function setIdFornecedor(int $idFornecedor): self { $this->idFornecedor = $idFornecedor; return $this; }
    public function setIdProduto(int $idProduto): self { $this->idProduto = $idProduto; return $this; }
}
