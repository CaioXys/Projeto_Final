<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualizar Cadastro - Administrador</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        .info-card {
            margin-bottom: 20px;
        }
        .section-title {
            background-color: #009688;
            color: white;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="w3-light-grey">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['Administrador'])) {
        header('Location: ../View/ADMLogin.php');
        exit;
    }

    if (!isset($_GET['id']) && !isset($_POST['idUsuario'])) {
        header('Location: ../View/ADMListarCadastrados.php');
        exit;
    }

    $idUsuario = isset($_GET['id']) ? $_GET['id'] : $_POST['idUsuario'];

    require_once '../Model/Usuario.php';
    require_once '../Model/FormacaoAcad.php';
    require_once '../Model/ExperienciaProfissional.php';
    require_once '../Model/OutrasFormacoes.php';

    $usuario = new Usuario();
    $usuario->carregarUsuarioPorId($idUsuario);

    $formacaoAcad = new FormacaoAcad();
    $experienciaPro = new ExperienciaProfissional();
    $outrasForm = new OutrasFormacoes();
    ?>

    <header class="w3-container w3-padding-32 w3-center w3-cyan">
        <h1 class="w3-text-white">
            <i class="fa fa-user-circle"></i> Visualização de Cadastro
        </h1>
        <p class="w3-text-white">Administrador: <?php echo htmlspecialchars(unserialize($_SESSION['Administrador'])->getNome()); ?></p>
    </header>

    <div class="w3-content" style="max-width:1000px; margin-top:30px;">

        <div class="w3-card-4 w3-white w3-margin-bottom info-card">
            <div class="section-title">
                <h3><i class="fa fa-address-card"></i> Dados Pessoais</h3>
            </div>
            <div class="w3-container w3-padding">
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <p><strong><i class="fa fa-user"></i> Nome:</strong></p>
                        <p class="w3-text-blue w3-large"><?php echo htmlspecialchars($usuario->getNome()); ?></p>
                    </div>
                    <div class="w3-half">
                        <p><strong><i class="fa fa-id-card"></i> CPF:</strong></p>
                        <p class="w3-text-blue w3-large"><?php echo htmlspecialchars($usuario->getCPF()); ?></p>
                    </div>
                </div>
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <p><strong><i class="fa fa-envelope"></i> Email:</strong></p>
                        <p class="w3-text-blue w3-large"><?php echo htmlspecialchars($usuario->getEmail()); ?></p>
                    </div>
                    <div class="w3-half">
                        <p><strong><i class="fa fa-calendar"></i> Data de Nascimento:</strong></p>
                        <p class="w3-text-blue w3-large">
                            <?php 
                            $dataNasc = $usuario->getDataNascimento();
                            echo $dataNasc ? date('d/m/Y', strtotime($dataNasc)) : 'Não informado'; 
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w3-card-4 w3-white w3-margin-bottom info-card">
            <div class="section-title">
                <h3><i class="fa fa-graduation-cap"></i> Formação Acadêmica</h3>
            </div>
            <div class="w3-container w3-padding">
                <?php
                $formacoes = $formacaoAcad->listaFormacoes($idUsuario);
                if ($formacoes && $formacoes->num_rows > 0) {
                    echo '<table class="w3-table w3-bordered w3-striped w3-hoverable">';
                    echo '<thead>';
                    echo '<tr class="w3-cyan">';
                    echo '<th><i class="fa fa-calendar"></i> Início</th>';
                    echo '<th><i class="fa fa-calendar"></i> Fim</th>';
                    echo '<th><i class="fa fa-book"></i> Descrição</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $formacoes->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                        echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-green">Cursando</span>') . '</td>';
                        echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p class="w3-text-grey w3-center"><i class="fa fa-info-circle"></i> Nenhuma formação acadêmica cadastrada.</p>';
                }
                ?>
            </div>
        </div>

        <div class="w3-card-4 w3-white w3-margin-bottom info-card">
            <div class="section-title">
                <h3><i class="fa fa-briefcase"></i> Experiência Profissional</h3>
            </div>
            <div class="w3-container w3-padding">
                <?php
                $experiencias = $experienciaPro->listaExperiencias($idUsuario);
                if ($experiencias && $experiencias->num_rows > 0) {
                    echo '<table class="w3-table w3-bordered w3-striped w3-hoverable">';
                    echo '<thead>';
                    echo '<tr class="w3-cyan">';
                    echo '<th><i class="fa fa-calendar"></i> Início</th>';
                    echo '<th><i class="fa fa-calendar"></i> Fim</th>';
                    echo '<th><i class="fa fa-building"></i> Empresa</th>';
                    echo '<th><i class="fa fa-info-circle"></i> Descrição</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $experiencias->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                        echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-blue">Atual</span>') . '</td>';
                        echo '<td><strong>' . htmlspecialchars($row->empresa) . '</strong></td>';
                        echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p class="w3-text-grey w3-center"><i class="fa fa-info-circle"></i> Nenhuma experiência profissional cadastrada.</p>';
                }
                ?>
            </div>
        </div>

        <div class="w3-card-4 w3-white w3-margin-bottom info-card">
            <div class="section-title">
                <h3><i class="fa fa-certificate"></i> Outras Formações</h3>
            </div>
            <div class="w3-container w3-padding">
                <?php
                $outras = $outrasForm->listaFormacoes($idUsuario);
                if ($outras && $outras->num_rows > 0) {
                    echo '<table class="w3-table w3-bordered w3-striped w3-hoverable">';
                    echo '<thead>';
                    echo '<tr class="w3-cyan">';
                    echo '<th><i class="fa fa-calendar"></i> Início</th>';
                    echo '<th><i class="fa fa-calendar"></i> Fim</th>';
                    echo '<th><i class="fa fa-book"></i> Descrição</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $outras->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                        echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-orange">Cursando</span>') . '</td>';
                        echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p class="w3-text-grey w3-center"><i class="fa fa-info-circle"></i> Nenhuma outra formação cadastrada.</p>';
                }
                ?>
            </div>
        </div>

        <div class="w3-center w3-margin-bottom w3-margin-top">
            <form action="../View/ADMListarCadastrados.php" method="post">
                <button type="submit" name="btnVoltarLista" class="w3-button w3-blue w3-round-large w3-large" style="width: 300px;">
                    <i class="fa fa-arrow-left"></i> Voltar para Lista de Usuários
                </button>
            </form>
        </div>

    </div>

    <footer class="w3-container w3-padding-32 w3-center w3-cyan w3-margin-top">
        <p class="w3-text-white">Sistema de Currículos - Painel Administrativo</p>
    </footer>

</body>
</html>