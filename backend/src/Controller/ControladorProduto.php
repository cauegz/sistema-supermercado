<?php

namespace App\Controller;

use App\DAO\ProdutoDAO;
use App\Controller\ControladorGeral;
use App\Model\Produto;
use App\Util\Request;
use App\Util\Validator;

class ControladorProduto extends ControladorGeral
{
    public function getProdutos(){
        $dao = new ProdutoDAO();
        echo $this->responseJSON($dao->findAll());
    }

    public function getProdutoById($id){
        $id = Validator::validaInt($id);

        $dao = new ProdutoDAO();
        
        echo $this->responseJSON($dao->findById($id));
    }

    public function criarProduto(){
        $dados = Request::body();
        
        if(!(Validator::validaProduto($dados))) exit($this->responseError("campos inválidos", 400));

        $produto = new Produto(
            $dados['nome'],
            $dados['preco'],
            $dados['descricao'],
            $dados['codigo_barras'],
            $dados['estoque_minimo'],
            $dados['id_marca'],
            $dados['id_categoria']
        );

        $dao = new ProdutoDAO();
        $dao->insert($produto); 
        echo $this->responseJSON(["mensagem" => "dados inseridos com sucesso"]);
    }

    public function editarProduto($id){
        $dados = Request::body();
        $id = Validator::validaInt($id);

        if(!(Validator::validaProduto($dados))) exit($this->responseError("campos inválidos", 400));

        $produto = new Produto(
            $dados['nome'],
            $dados['preco'],
            $dados['descricao'],
            $dados['codigo_barras'],
            $dados['estoque_minimo'],
            $dados['id_marca'],
            $dados['id_categoria']
        );
        
        $dao = new ProdutoDAO();
        $linhas = $dao->update($produto, $id);

        if($linhas > 0) 
            echo $this->responseJSON(["mensagem" => "dados editados com sucesso"]) ;
        else if($linhas === 0)
            exit($this->responseError("registro não existe", 404));
    }

    public function excluirProduto($id){
        $id = Validator::validaInt($id);
        $dao = new ProdutoDAO();
        $linhas = $dao->delete($id);

        if($linhas > 0) 
            echo $this->responseJSON(["mensagem" => "dados exluidos com sucesso"]) ;
        else if($linhas === 0)
            exit($this->responseError("registro não existe", 404));
    }
}
