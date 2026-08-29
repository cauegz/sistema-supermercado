-- Senha dos usuarios de acesso criados neste arquivo: senha123

-- ==========================
-- FUNCIONARIO
-- ==========================
INSERT INTO funcionario (nome, salario, cpf) VALUES
('Joao Silva', 3200.00, '12345678901'),
('Maria Oliveira', 4100.00, '23456789012'),
('Carlos Souza', 3800.00, '34567890123'),
('Ana Pereira', 4500.00, '45678901234'),
('Pedro Santos', 3600.00, '56789012345');

-- ==========================
-- PAPEL_USUARIO
-- ==========================
INSERT INTO papel_usuario (nome) VALUES
('administrador'),
('funcionario');

-- ==========================
-- USUARIO_ACESSO
-- ==========================
INSERT INTO usuario_acesso (email, senha, id_funcionario, id_papel) VALUES
('joao@mercado.com', '$2y$10$mewHBl5y90y/1M42e9mTF.DVdGrbGe0tD1XFor43ZqjuoaLHaUFnK', 1, 1),
('maria@mercado.com', '$2y$10$mewHBl5y90y/1M42e9mTF.DVdGrbGe0tD1XFor43ZqjuoaLHaUFnK', 2, 2),
('carlos@mercado.com', '$2y$10$mewHBl5y90y/1M42e9mTF.DVdGrbGe0tD1XFor43ZqjuoaLHaUFnK', 3, 2),
('ana@mercado.com', '$2y$10$mewHBl5y90y/1M42e9mTF.DVdGrbGe0tD1XFor43ZqjuoaLHaUFnK', 4, 2);

-- ==========================
-- CLIENTE
-- ==========================
INSERT INTO cliente (nome, email, cpf) VALUES
('Lucas Almeida', 'lucas@email.com', '11111111111'),
('Fernanda Costa', 'fernanda@email.com', '22222222222'),
('Bruno Lima', 'bruno@email.com', '33333333333'),
('Juliana Rocha', 'juliana@email.com', '44444444444'),
('Gabriel Martins', 'gabriel@email.com', '55555555555');

-- ==========================
-- CATEGORIA
-- ==========================
INSERT INTO categoria (nome) VALUES
('Mercearia'),
('Laticinios'),
('Bebidas'),
('Limpeza');

-- ==========================
-- MARCA
-- ==========================
INSERT INTO marca (nome) VALUES
('Grao Bom'),
('Fazenda Sul'),
('Cafe Colonial'),
('Casa Limpa'),
('Vale Natural');

-- ==========================
-- FORNECEDOR
-- ==========================
INSERT INTO fornecedor (razao_social, cnpj, telefone, email) VALUES
('Distribuidora de Alimentos Sul Ltda', '12345678000101', '(51) 3333-1001', 'contato@alimentosul.com'),
('Laticinios Serra Ltda', '23456789000102', '(51) 3333-1002', 'vendas@laticiniosserra.com'),
('Produtos de Limpeza Brasil Ltda', '34567890000103', '(51) 3333-1003', 'comercial@limpezabrasil.com');

-- ==========================
-- PRODUTO
-- ==========================
INSERT INTO produto
    (nome, preco, descricao, codigo_barras, estoque_minimo, id_marca, id_categoria)
VALUES
('Arroz branco 5 kg', 25.90, 'Arroz branco tipo 1', '7891000000011', 10.000, 1, 1),
('Feijao preto 1 kg', 8.99, 'Feijao preto tipo 1', '7891000000028', 15.000, 1, 1),
('Leite integral 1 L', 5.49, 'Leite UHT integral', '7891000000035', 24.000, 2, 2),
('Cafe torrado 500 g', 18.90, 'Cafe torrado e moido', '7891000000042', 10.000, 3, 1),
('Detergente neutro 500 ml', 2.79, 'Detergente liquido neutro', '7891000000059', 20.000, 4, 4),
('Suco de uva integral 1 L', 14.50, 'Suco de uva integral', '7891000000066', 12.000, 5, 3);

-- ==========================
-- PRODUTO_FORNECEDOR
-- ==========================
INSERT INTO produto_fornecedor
    (codigo_fornecedor, ultimo_custo, id_fornecedor, id_produto)
VALUES
('ALI-ARROZ-5KG', 20.50, 1, 1),
('ALI-FEIJAO-1KG', 6.70, 1, 2),
('LAT-LEITE-1L', 4.10, 2, 3),
('ALI-CAFE-500G', 14.80, 1, 4),
('LIM-DET-500ML', 1.85, 3, 5),
('ALI-SUCO-UVA-1L', 11.20, 1, 6);

-- ==========================
-- VENDA
-- ==========================
INSERT INTO venda (data, valor, id_funcionario, id_cliente) VALUES
('2026-07-01 10:30:00', 43.88, 1, 1),
('2026-07-02 14:15:00', 32.94, 2, 2),
('2026-07-03 09:20:00', 46.17, 3, 3),
('2026-07-04 16:45:00', 73.76, 4, 4),
('2026-07-05 11:10:00', 45.87, 5, NULL);

-- ==========================
-- ITEM_VENDA
-- ==========================
INSERT INTO item_venda
    (preco_unitario, quantidade, id_produto, id_venda)
VALUES
(25.90, 1, 1, 1),
(8.99, 2, 2, 1),
(5.49, 6, 3, 2),
(18.90, 2, 4, 3),
(2.79, 3, 5, 3),
(25.90, 2, 1, 4),
(5.49, 4, 3, 4),
(8.99, 3, 2, 5),
(18.90, 1, 4, 5);

-- ==========================
-- AVALIACAO
-- ==========================
INSERT INTO avaliacao (nota, comentario, id_funcionario, id_cliente) VALUES
(5, 'Excelente atendimento.', 1, 1),
(4, 'Atendimento rapido e cordial.', 2, 2),
(5, 'Funcionario muito prestativo.', 3, 3),
(3, 'Atendimento razoavel.', 4, 4),
(5, 'Voltarei a comprar.', 5, 5);
