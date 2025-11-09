<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Meu Currículo</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        .w3-sidebar {
            width: 150px;
        }
        #main {
            margin-left: 150px;
        }
        @media (max-width: 768px) {
            .w3-sidebar {
                display: none;
            }
            #main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="w3-light-grey">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verificar se usuário está logado
    if (!isset($_SESSION['Usuario'])) {
        header('Location: ../View/login.php');
        exit;
    }

    $usuario = unserialize($_SESSION['Usuario']);
    
    // Carregar as formações
    require_once '../Model/FormacaoAcad.php';
    require_once '../Model/ExperienciaProfissional.php';
    require_once '../Model/OutrasFormacoes.php';

    $formacaoAcad = new FormacaoAcad();
    $experienciaPro = new ExperienciaProfissional();
    $outrasForm = new OutrasFormacoes();
    ?>

    <!-- Sidebar -->
    <nav class="w3-sidebar w3-bar-block w3-center w3-cyan w3-collapse" id="mySidebar">
        <a href="#home" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>HOME</p>
        </a>
        <a href="#dPessoais" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-address-book-o w3-xxlarge"></i>
            <p>Dados Pessoais</p>
        </a>
        <a href="#formacao" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-graduation-cap w3-xxlarge"></i>
            <p>Formação</p>
        </a>
        <a href="#experiencias" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-briefcase w3-xxlarge"></i>
            <p>Experiências</p>
        </a>
        <a href="#outrasFormacoes" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-plus-square w3-xxlarge"></i>
            <p>Outras Formações</p>
        </a>
    </nav>

    <div class="w3-main" id="main">
        <header class="w3-container w3-padding-32 w3-center w3-cyan" id="home">
            <h1 class="w3-text-white">
                <i class="fa fa-file-text-o"></i> SISTEMA DE CURRÍCULOS
            </h1>
            <p class="w3-text-white w3-large">Bem-vindo(a), <?php echo htmlspecialchars($usuario->getNome()); ?>!</p>
        </header>

        <div class="w3-padding-large w3-content" style="max-width:1000px">
            
            <!-- Dados Pessoais -->
            <div id="dPessoais" class="w3-padding-32">
                <h2 class="w3-text-cyan"><i class="fa fa-user"></i> Dados Pessoais</h2>
                <hr class="w3-opacity">
                <form action="../Controller/Navegacao.php" method="post" class="w3-container w3-card-4 w3-white w3-text-blue w3-padding-16 w3-round-large">
                    <input type="hidden" name="txtID" value="<?php echo $usuario->getID(); ?>">
                    
                    <div class="w3-row-padding">
                        <div class="w3-section">
                            <label><i class="fa fa-user"></i> Nome Completo</label>
                            <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" value="<?php echo htmlspecialchars($usuario->getNome()); ?>" required>
                        </div>
                    </div>
                    
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label><i class="fa fa-id-card"></i> CPF</label>
                            <input class="w3-input w3-border w3-round-large" name="txtCPF" type="text" value="<?php echo htmlspecialchars($usuario->getCPF()); ?>" readonly>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-envelope"></i> Email</label>
                            <input class="w3-input w3-border w3-round-large" name="txtEmail" type="email" value="<?php echo htmlspecialchars($usuario->getEmail()); ?>" required>
                        </div>
                    </div>
                    
                    <div class="w3-section">
                        <label><i class="fa fa-calendar"></i> Data de Nascimento</label>
                        <input class="w3-input w3-border w3-round-large" name="txtDataNascimento" type="date" value="<?php echo $usuario->getDataNascimento(); ?>">
                    </div>
                    
                    <div class="w3-center">
                        <button name="btnAtualizarDados" class="w3-button w3-cyan w3-round-large w3-large" style="width:50%;">
                            <i class="fa fa-save"></i> Atualizar Dados
                        </button>
                    </div>
                </form>
            </div>

            <!-- Formação Acadêmica -->
            <div id="formacao" class="w3-padding-32">
                <h2 class="w3-text-cyan"><i class="fa fa-graduation-cap"></i> Formação Acadêmica</h2>
                <hr class="w3-opacity">
                <form action="../Controller/FormacaoController.php" method="post" class="w3-container w3-card-4 w3-white w3-text-blue w3-padding-16 w3-round-large">
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Inicial</label>
                            <input class="w3-input w3-border w3-round-large" name="txtInicioFA" type="date" required>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Final</label>
                            <input class="w3-input w3-border w3-round-large" name="txtFimFA" type="date">
                            <small class="w3-text-grey">Deixe vazio se ainda estiver cursando</small>
                        </div>
                    </div>
                    <div class="w3-section">
                        <label><i class="fa fa-book"></i> Descrição</label>
                        <input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text" placeholder="Ex.: Técnico em Desenvolvimento de Sistemas - Centro Paula Souza" required>
                    </div>
                    <div class="w3-center">
                        <button name="btnAddFormacao" class="w3-button w3-cyan w3-round-large w3-large" style="width:50%;">
                            <i class="fa fa-plus"></i> Adicionar Formação
                        </button>
                    </div>
                </form>
                
                <!-- Tabela de Formações -->
                <div class="w3-container w3-padding-16">
                    <table class="w3-table-all w3-centered w3-card-4 w3-white">
                        <thead>
                            <tr class="w3-cyan">
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Descrição</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $formacoes = $formacaoAcad->listaFormacoes($usuario->getID());
                            if($formacoes && $formacoes->num_rows > 0) {
                                while($row = $formacoes->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                                    echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-green">Cursando</span>') . '</td>';
                                    echo '<td class="w3-left-align">' . htmlspecialchars($row->descricao) . '</td>';
                                    echo '<td><form method="post" action="../Controller/FormacaoController.php" style="display:inline;">
                                        <input type="hidden" name="idExcluir" value="' . $row->idformacaoAcademica . '">
                                        <button type="submit" name="btnExcluirFA" class="w3-button w3-red w3-round" onclick="return confirm(\'Deseja realmente excluir esta formação?\')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="w3-text-grey">Nenhuma formação cadastrada</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Experiências Profissionais -->
            <div id="experiencias" class="w3-padding-32">
                <h2 class="w3-text-cyan"><i class="fa fa-briefcase"></i> Experiências Profissionais</h2>
                <hr class="w3-opacity">
                <form action="../Controller/ExperienciaController.php" method="post" class="w3-container w3-card-4 w3-white w3-text-blue w3-padding-16 w3-round-large">
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Inicial</label>
                            <input class="w3-input w3-border w3-round-large" name="txtInicioEP" type="date" required>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Final</label>
                            <input class="w3-input w3-border w3-round-large" name="txtFimEP" type="date">
                            <small class="w3-text-grey">Deixe vazio se ainda trabalhar nesta empresa</small>
                        </div>
                    </div>
                    <div class="w3-section">
                        <label><i class="fa fa-building"></i> Empresa</label>
                        <input class="w3-input w3-border w3-round-large" name="txtEmpresaEP" type="text" placeholder="Nome da Empresa" required>
                    </div>
                    <div class="w3-section">
                        <label><i class="fa fa-align-justify"></i> Descrição</label>
                        <input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text" placeholder="Ex.: Desenvolvedor Web - Desenvolvimento de sistemas" required>
                    </div>
                    <div class="w3-center">
                        <button name="btnAddExperiencia" class="w3-button w3-cyan w3-round-large w3-large" style="width:50%;">
                            <i class="fa fa-plus"></i> Adicionar Experiência
                        </button>
                    </div>
                </form>
                
                <!-- Tabela de Experiências -->
                <div class="w3-container w3-padding-16">
                    <table class="w3-table-all w3-centered w3-card-4 w3-white">
                        <thead>
                            <tr class="w3-cyan">
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Empresa</th>
                                <th>Descrição</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $experiencias = $experienciaPro->listaExperiencias($usuario->getID());
                            if($experiencias && $experiencias->num_rows > 0) {
                                while($row = $experiencias->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                                    echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-blue">Atual</span>') . '</td>';
                                    echo '<td><strong>' . htmlspecialchars($row->empresa) . '</strong></td>';
                                    echo '<td class="w3-left-align">' . htmlspecialchars($row->descricao) . '</td>';
                                    echo '<td><form method="post" action="../Controller/ExperienciaController.php" style="display:inline;">
                                        <input type="hidden" name="idExcluir" value="' . $row->idexperienciaprofissional . '">
                                        <button type="submit" name="btnExcluirEP" class="w3-button w3-red w3-round" onclick="return confirm(\'Deseja realmente excluir esta experiência?\')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="w3-text-grey">Nenhuma experiência cadastrada</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Outras Formações -->
            <div id="outrasFormacoes" class="w3-padding-32">
                <h2 class="w3-text-cyan"><i class="fa fa-certificate"></i> Outras Formações</h2>
                <hr class="w3-opacity">
                <form action="../Controller/OutrasFormacoesController.php" method="post" class="w3-container w3-card-4 w3-white w3-text-blue w3-padding-16 w3-round-large">
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Inicial</label>
                            <input class="w3-input w3-border w3-round-large" name="txtInicioOF" type="date" required>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-calendar"></i> Data Final</label>
                            <input class="w3-input w3-border w3-round-large" name="txtFimOF" type="date">
                            <small class="w3-text-grey">Deixe vazio se ainda estiver cursando</small>
                        </div>
                    </div>
                    <div class="w3-section">
                        <label><i class="fa fa-book"></i> Descrição</label>
                        <input class="w3-input w3-border w3-round-large" name="txtDescOF" type="text" placeholder="Ex.: Curso de Inglês Avançado" required>
                    </div>
                    <div class="w3-center">
                        <button name="btnAddOutrasFormacoes" class="w3-button w3-cyan w3-round-large w3-large" style="width:50%;">
                            <i class="fa fa-plus"></i> Adicionar Formação
                        </button>
                    </div>
                </form>
                
                <!-- Tabela de Outras Formações -->
                <div class="w3-container w3-padding-16">
                    <table class="w3-table-all w3-centered w3-card-4 w3-white">
                        <thead>
                            <tr class="w3-cyan">
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Descrição</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $outras = $outrasForm->listaFormacoes($usuario->getID());
                            if($outras && $outras->num_rows > 0) {
                                while($row = $outras->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td>' . date('d/m/Y', strtotime($row->inicio)) . '</td>';
                                    echo '<td>' . ($row->fim ? date('d/m/Y', strtotime($row->fim)) : '<span class="w3-tag w3-orange">Cursando</span>') . '</td>';
                                    echo '<td class="w3-left-align">' . htmlspecialchars($row->descricao) . '</td>';
                                    echo '<td><form method="post" action="../Controller/OutrasFormacoesController.php" style="display:inline;">
                                        <input type="hidden" name="idExcluir" value="' . $row->idoutrasformacoes . '">
                                        <button type="submit" name="btnExcluirOF" class="w3-button w3-red w3-round" onclick="return confirm(\'Deseja realmente excluir esta formação?\')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="w3-text-grey">Nenhuma formação cadastrada</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Botão de Logout -->
            <div class="w3-center w3-padding-32">
                <form method="post" action="../Controller/Navegacao.php">
                    <button name="btnLogout" class="w3-button w3-red w3-round-large w3-large">
                        <i class="fa fa-sign-out"></i> Sair do Sistema
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>