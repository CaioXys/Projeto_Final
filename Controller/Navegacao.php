<?php
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_POST)) {
    include_once "View/login.php";

// Primeiro acesso
} elseif (isset($_POST["btnPrimeiroAcesso"])) {
    include_once "../View/primeiroAcesso.php";

// Cadastrar usuário
} elseif (isset($_POST["btnCadastrar"])) {
    require_once __DIR__ . "/UsuarioController.php";
    $uController = new UsuarioController();
    if (
        $uController->inserir(
            $_POST["txtNome"],
            $_POST["txtCPF"],
            $_POST["txtEmail"],
            $_POST["txtSenha"]
        )
    ) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }

} else {
    include_once "View/login.php";
}

if(isset($_POST["btnListarCadastrados"]))
{
include_once '../View/ADMListarCadastrados.php';
} 

?>