
CREATE TABLE avaliacao
(
  id_avaliacao   INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  nota           INT         ,
  comentario     VARCHAR(255),
  id_funcionario INT          NOT NULL,
  id_cliente     INT         ,
  PRIMARY KEY (id_avaliacao)
);

CREATE TABLE categoria
(
  id_categoria INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome         VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_categoria)
);

CREATE TABLE cliente
(
  id_cliente INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome       VARCHAR(100),
  email      VARCHAR(100),
  cpf        CHAR(11)     UNIQUE,
  PRIMARY KEY (id_cliente)
);

CREATE TABLE fornecedor
(
  id_fornecedor INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  razao_social  VARCHAR(150) NOT NULL,
  cnpj          CHAR(14)     UNIQUE,
  telefone      VARCHAR(20) ,
  email         VARCHAR(150) UNIQUE,
  PRIMARY KEY (id_fornecedor)
);

CREATE TABLE funcionario
(
  id_funcionario INT           NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome           VARCHAR(100) ,
  salario        DECIMAL(10,2),
  cpf            CHAR(11)      NOT NULL UNIQUE,
  PRIMARY KEY (id_funcionario)
);

CREATE TABLE item_venda
(
  id_item_venda  INT           NOT NULL GENERATED ALWAYS AS IDENTITY,
  preco_unitario DECIMAL(10,2) NOT NULL,
  quantidade     INT           NOT NULL,
  id_produto     INT           NOT NULL,
  id_venda       INT           NOT NULL,
  PRIMARY KEY (id_item_venda)
);

CREATE TABLE marca
(
  id_marca INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome     VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_marca)
);

CREATE TABLE papel_usuario
(
  id_papel INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome     VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_papel)
);

CREATE TABLE produto
(
  id_produto     INT           NOT NULL GENERATED ALWAYS AS IDENTITY,
  nome           VARCHAR(100)  NOT NULL,
  preco          DECIMAL(10,2) NOT NULL,
  descricao      VARCHAR(255) ,
  codigo_barras  VARCHAR(14)   UNIQUE,
  estoque_minimo DECIMAL(12,3) NOT NULL DEFAULT 0,
  id_marca       INT           NOT NULL,
  id_categoria   INT           NOT NULL,
  PRIMARY KEY (id_produto)
);

CREATE TABLE produto_fornecedor
(
  id_produto_fornecedor INT           NOT NULL GENERATED ALWAYS AS IDENTITY,
  codigo_fornecedor     VARCHAR(50)  ,
  ultimo_custo          DECIMAL(10,2),
  id_fornecedor         INT           NOT NULL,
  id_produto            INT           NOT NULL,
  PRIMARY KEY (id_produto_fornecedor)
);

CREATE TABLE usuario_acesso
(
  id_usuario_acesso INT          NOT NULL GENERATED ALWAYS AS IDENTITY,
  id_papel          INT          NOT NULL,
  id_funcionario    INT          NOT NULL UNIQUE,
  email             VARCHAR(150) NOT NULL UNIQUE,
  senha             VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_usuario_acesso)
);

CREATE TABLE venda
(
  id_venda       INT           NOT NULL GENERATED ALWAYS AS IDENTITY,
  data           TIMESTAMP     NOT NULL,
  valor          DECIMAL(10,2),
  id_funcionario INT           NOT NULL,
  id_cliente     INT          ,
  PRIMARY KEY (id_venda)
);

ALTER TABLE item_venda
  ADD CONSTRAINT FK_produto_TO_item_venda
    FOREIGN KEY (id_produto)
    REFERENCES produto (id_produto);

ALTER TABLE item_venda
  ADD CONSTRAINT FK_venda_TO_item_venda
    FOREIGN KEY (id_venda)
    REFERENCES venda (id_venda);

ALTER TABLE venda
  ADD CONSTRAINT FK_funcionario_TO_venda
    FOREIGN KEY (id_funcionario)
    REFERENCES funcionario (id_funcionario);

ALTER TABLE venda
  ADD CONSTRAINT FK_cliente_TO_venda
    FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente);

ALTER TABLE avaliacao
  ADD CONSTRAINT FK_cliente_TO_avaliacao
    FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente);

ALTER TABLE avaliacao
  ADD CONSTRAINT FK_funcionario_TO_avaliacao
    FOREIGN KEY (id_funcionario)
    REFERENCES funcionario (id_funcionario);

ALTER TABLE produto
  ADD CONSTRAINT FK_marca_TO_produto
    FOREIGN KEY (id_marca)
    REFERENCES marca (id_marca);

ALTER TABLE produto
  ADD CONSTRAINT FK_categoria_TO_produto
    FOREIGN KEY (id_categoria)
    REFERENCES categoria (id_categoria);

ALTER TABLE produto_fornecedor
  ADD CONSTRAINT FK_fornecedor_TO_produto_fornecedor
    FOREIGN KEY (id_fornecedor)
    REFERENCES fornecedor (id_fornecedor);

ALTER TABLE produto_fornecedor
  ADD CONSTRAINT FK_produto_TO_produto_fornecedor
    FOREIGN KEY (id_produto)
    REFERENCES produto (id_produto);

ALTER TABLE usuario_acesso
  ADD CONSTRAINT FK_funcionario_TO_usuario_acesso
    FOREIGN KEY (id_funcionario)
    REFERENCES funcionario (id_funcionario);

ALTER TABLE usuario_acesso
  ADD CONSTRAINT FK_papel_usuario_TO_usuario_acesso
    FOREIGN KEY (id_papel)
    REFERENCES papel_usuario (id_papel);
