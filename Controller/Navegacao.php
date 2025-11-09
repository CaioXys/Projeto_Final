<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["btnLogout"])) {
    session_destroy();
    include_once "../View/login.php";
    exit;
}

if (isset($_POST["btnADM"])) {
    include_once '../View/ADMLogin.php';
    exit;
}

if (isset($_POST["btnLoginADM"])) {
    require_once '../Controller/AdministradorController.php';
    $aController = new AdministradorController();
    if ($aController->login($_POST['txtLoginADM'], $_POST['txtSenhaADM'])) {
        include_once '../View/ADMPrincipal.php';
    } else {
        echo "<script>alert('Login de administrador inválido!'); window.location.href='../View/ADMLogin.php';</script>";
    }
    exit;
}

if (isset($_POST["btnListarCadastrados"])) {
    if (isset($_SESSION['Administrador'])) {
        include_once '../View/ADMListarCadastrados.php';
    } else {
        echo "<script>alert('Acesso negado!'); window.location.href='../index.php';</script>";
    }
    exit;
}

// Voltar (de qualquer tela de administrador)
if (isset($_POST["btnVoltar"])) {
    if (isset($_SESSION['Administrador'])) {
        include_once '../View/ADMPrincipal.php';
    } else {
        include_once "../View/login.php";
    }
    exit;
}

if (isset($_POST["btnLogin"])) {
    require_once __DIR__ . "/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
        include_once "../View/VisualizarCadastro.php";
    } else {
        echo "<script>alert('CPF ou senha inválidos!'); window.location.href='../index.php';</script>";
    }
    exit;
}

if (isset($_POST["btnPrimeiroAcesso"])) {
    include_once "../View/primeiroAcesso.php";
    exit;
}

if (isset($_POST["btnCadastrar"])) {
    require_once __DIR__ . "/UsuarioController.php";
    $uController = new UsuarioController();

    $nome = isset($_POST["txtNome"]) ? trim($_POST["txtNome"]) : '';
    $cpf = isset($_POST["txtCPF"]) ? trim($_POST["txtCPF"]) : '';
    $email = isset($_POST["txtEmail"]) ? trim($_POST["txtEmail"]) : '';
    $senha = isset($_POST["txtSenha"]) ? trim($_POST["txtSenha"]) : '';
    
    if ($nome === '' || $cpf === '' || $email === '' || $senha === '') {
        echo "<script>alert('Preencha todos os campos!'); window.history.back();</script>";
        exit;
    }
    
    if ($uController->inserir($nome, $cpf, $email, $senha)) {
        include_once "../View/cadastroRealizado.php";
        echo "<script>setTimeout(function(){ window.location.href='../View/VisualizarCadastro.php'; }, 2000);</script>";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
        echo "<script>setTimeout(function(){ window.location.href='../index.php'; }, 2000);</script>";
    }
    exit;
}

if (isset($_POST["btnAtualizarDados"])) {
    if (!isset($_SESSION['Usuario'])) {
        header('Location: ../View/login.php');
        exit;
    }
    
    $usuario = unserialize($_SESSION['Usuario']);
    $usuario->setNome($_POST["txtNome"]);
    $usuario->setEmail($_POST["txtEmail"]);
    
    $dataNasc = isset($_POST["txtDataNascimento"]) ? $_POST["txtDataNascimento"] : '';
    $usuario->setDataNascimento($dataNasc);
    
    if ($usuario->atualizarBD()) {
        $_SESSION['Usuario'] = serialize($usuario);
        include_once "../View/atualizacaoRealizada.php";
        echo "<script>setTimeout(function(){ window.location.href='../View/VisualizarCadastro.php'; }, 2000);</script>";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
        echo "<script>setTimeout(function(){ window.location.href='../View/VisualizarCadastro.php'; }, 2000);</script>";
    }
    exit;
}

$postCount = count($_POST);
if ($postCount === 0) {
    include_once "View/login.php";
} else {
    include_once "View/login.php";
}
?>