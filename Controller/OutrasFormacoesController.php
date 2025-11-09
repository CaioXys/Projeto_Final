<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['Usuario'])) {
    header('Location: ../View/login.php');
    exit;
}

$usuario = unserialize($_SESSION['Usuario']);
require_once '../Model/OutrasFormacoes.php';

if (isset($_POST['btnAddOutrasFormacoes'])) {
    $inicio = isset($_POST['txtInicioOF']) ? trim($_POST['txtInicioOF']) : '';
    $descricao = isset($_POST['txtDescOF']) ? trim($_POST['txtDescOF']) : '';
    
    if ($inicio === '' || $descricao === '') {
        echo '<script>alert("Por favor, preencha todos os campos obrigatórios!"); window.history.back();</script>';
        exit;
    }
    
    $formacao = new OutrasFormacoes();
    $formacao->setIdUsuario($usuario->getID());
    $formacao->setInicio($_POST['txtInicioOF']);
    $formacao->setFim(isset($_POST['txtFimOF']) ? $_POST['txtFimOF'] : '');
    $formacao->setDescricao($_POST['txtDescOF']);
    
    if ($formacao->inserirBD()) {
        echo '<script>
            alert("Formação adicionada com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#outrasFormacoes";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao adicionar formação! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#outrasFormacoes";
        </script>';
    }
    exit;
}

if (isset($_POST['btnExcluirOF'])) {
    $idExcluir = isset($_POST['idExcluir']) ? trim($_POST['idExcluir']) : '';
    
    if ($idExcluir === '') {
        echo '<script>alert("ID inválido!"); window.history.back();</script>';
        exit;
    }
    
    $formacao = new OutrasFormacoes();
    if ($formacao->excluirBD($_POST['idExcluir'])) {
        echo '<script>
            alert("Formação excluída com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#outrasFormacoes";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao excluir formação! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#outrasFormacoes";
        </script>';
    }
    exit;
}

header('Location: ../View/VisualizarCadastro.php');
exit;
?>