<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['Usuario'])) {
    header('Location: ../View/login.php');
    exit;
}

$usuario = unserialize($_SESSION['Usuario']);
require_once '../Model/FormacaoAcad.php';

if (isset($_POST['btnAddFormacao'])) {
    $inicio = isset($_POST['txtInicioFA']) ? trim($_POST['txtInicioFA']) : '';
    $descricao = isset($_POST['txtDescFA']) ? trim($_POST['txtDescFA']) : '';
    
    if ($inicio === '' || $descricao === '') {
        echo '<script>alert("Por favor, preencha todos os campos obrigatórios!"); window.history.back();</script>';
        exit;
    }
    
    $formacao = new FormacaoAcad();
    $formacao->setIdUsuario($usuario->getID());
    $formacao->setInicio($_POST['txtInicioFA']);
    $formacao->setFim(isset($_POST['txtFimFA']) ? $_POST['txtFimFA'] : '');
    $formacao->setDescricao($_POST['txtDescFA']);
    
    if ($formacao->inserirBD()) {
        echo '<script>
            alert("Formação acadêmica adicionada com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#formacao";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao adicionar formação! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#formacao";
        </script>';
    }
    exit;
}

if (isset($_POST['btnExcluirFA'])) {
    $idExcluir = isset($_POST['idExcluir']) ? trim($_POST['idExcluir']) : '';
    
    if ($idExcluir === '') {
        echo '<script>alert("ID inválido!"); window.history.back();</script>';
        exit;
    }
    
    $formacao = new FormacaoAcad();
    if ($formacao->excluirBD($_POST['idExcluir'])) {
        echo '<script>
            alert("Formação acadêmica excluída com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#formacao";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao excluir formação! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#formacao";
        </script>';
    }
    exit;
}

header('Location: ../View/VisualizarCadastro.php');
exit;
?>