<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['Usuario'])) {
    header('Location: ../View/login.php');
    exit;
}

$usuario = unserialize($_SESSION['Usuario']);
require_once '../Model/ExperienciaProfissional.php';

if (isset($_POST['btnAddExperiencia'])) {
    $inicio = isset($_POST['txtInicioEP']) ? trim($_POST['txtInicioEP']) : '';
    $empresa = isset($_POST['txtEmpresaEP']) ? trim($_POST['txtEmpresaEP']) : '';
    $descricao = isset($_POST['txtDescEP']) ? trim($_POST['txtDescEP']) : '';
    
    if ($inicio === '' || $empresa === '' || $descricao === '') {
        echo '<script>alert("Por favor, preencha todos os campos obrigatórios!"); window.history.back();</script>';
        exit;
    }
    
    $experiencia = new ExperienciaProfissional();
    $experiencia->setIdUsuario($usuario->getID());
    $experiencia->setInicio($_POST['txtInicioEP']);
    $experiencia->setFim(isset($_POST['txtFimEP']) ? $_POST['txtFimEP'] : '');
    $experiencia->setEmpresa($_POST['txtEmpresaEP']);
    $experiencia->setDescricao($_POST['txtDescEP']);
    
    if ($experiencia->inserirBD()) {
        echo '<script>
            alert("Experiência profissional adicionada com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#experiencias";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao adicionar experiência! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#experiencias";
        </script>';
    }
    exit;
}

if (isset($_POST['btnExcluirEP'])) {
    $idExcluir = isset($_POST['idExcluir']) ? trim($_POST['idExcluir']) : '';
    
    if ($idExcluir === '') {
        echo '<script>alert("ID inválido!"); window.history.back();</script>';
        exit;
    }
    
    $experiencia = new ExperienciaProfissional();
    if ($experiencia->excluirBD($_POST['idExcluir'])) {
        echo '<script>
            alert("Experiência profissional excluída com sucesso!");
            window.location.href="../View/VisualizarCadastro.php#experiencias";
        </script>';
    } else {
        echo '<script>
            alert("Erro ao excluir experiência! Por favor, tente novamente.");
            window.location.href="../View/VisualizarCadastro.php#experiencias";
        </script>';
    }
    exit;
}

header('Location: ../View/VisualizarCadastro.php');
exit;
?>