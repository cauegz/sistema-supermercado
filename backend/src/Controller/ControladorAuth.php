<?php
namespace App\Controller;

use App\Controller\ControladorGeral;
use App\DAO\UsuarioAcessoDAO;
use App\DAO\FuncionarioDAO;
use App\Util\Request;
use App\Util\Validator;
use App\Model\UsuarioAcesso;

class ControladorAuth extends ControladorGeral{
    public function login(){
        $dados = Request::body();

        if(!(Validator::validaLogin($dados))) exit($this->responseError("campos inválidos", 400));

        $usuarioAcesso = (new UsuarioAcessoDAO())->findByEmail($dados["email"]);

        if(!$usuarioAcesso || !(password_verify($dados['senha'], $usuarioAcesso->getSenha()))) exit($this->responseError("credenciais inválidas", 401));

        session_regenerate_id(true);

        $_SESSION['id_usuario'] = $usuarioAcesso->getId();
        $_SESSION['id_funcionario'] = $usuarioAcesso->getIdFuncionario();
        $_SESSION['id_papel'] = $usuarioAcesso->getIdPapel();

        echo $this->responseJSON([
            "mensagem" => "login realizado com sucesso"
        ]);
    }

    /**
     * Registra um novo funcionário com as credenciais necessárias para utilizar o sistema
     */
    public function register(){
        $dados = Request::body();
        
        if(!(Validator::validaRegistro($dados))) exit($this->responseError("campos inválidos", 400));

        $daoAcesso = new UsuarioAcessoDAO;
        $daoFuncionario = new FuncionarioDAO;

        if($daoAcesso->findByIdFuncionario($dados['id_funcionario'])) exit($this->responseError("funcionário já está cadastrado com acesso", 409));
        if(!($daoFuncionario->findById($dados['id_funcionario']))) exit($this->responseError("funcionário não existe", 404));

        $usuarioAcesso = new UsuarioAcesso(
            $dados['email'],
            password_hash($dados['senha'], PASSWORD_DEFAULT),
            $dados['id_funcionario'],
            $dados['id_papel']
        );

        
        $daoAcesso->insert($usuarioAcesso);
        echo $this->responseJSON(["mensagem" => "usuário cadastrado com sucesso"]);
    }

    public function logout(){
        $_SESSION = [];
        session_unset();
        session_destroy();
        echo $this->responseJSON(["mensagem" => "logout realizado com sucesso"]);
    }
}