<?php
if (!isset($_SESSION)) {
    session_start();
}

class UsuarioController {
    public function inserir($nome, $cpf, $email, $senha) {
        require_once __DIR__ . '/../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $r = $usuario->inserirBD();
        if($r) {
            $_SESSION['Usuario'] = serialize($usuario);
        }
        return $r;
    }

    public function login($cpf, $senha) {
        require_once __DIR__ . '/../Model/Usuario.php';
        $usuario = new Usuario();
        if($usuario->carregarUsuario($cpf)) {
            if(password_verify($senha, $usuario->getSenha())) {
                $_SESSION['Usuario'] = serialize($usuario);
                return true;
            }
        }
        return false;
    }

    public function gerarLista() {
        require_once __DIR__ . '/../Model/Usuario.php';
        $u = new Usuario();
        return $u->listaCadastrados();
    }
}
?>