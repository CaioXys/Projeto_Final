<?php
if (!isset($_SESSION)) {
    session_start();
}

class UsuarioController
{
    public function inserir($nome, $cpf, $email, $senha)
    {
        require_once __DIR__ . '/../Model/Usuario.php'; // Caminho corrigido
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $r = $usuario->inserirBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }
}
?>