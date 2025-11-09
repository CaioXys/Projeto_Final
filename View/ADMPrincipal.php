<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Painel de Administração</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            transition: all 0.3s;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .card-hover {
            transition: all 0.3s;
        }
    </style>
</head>
<body class="w3-light-grey">
    <?php
    if(!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['Administrador'])) {
        header('Location: ../View/ADMLogin.php');
        exit;
    }
    
    $administrador = unserialize($_SESSION['Administrador']);
    ?>
    
    <div class="w3-padding-large" id="main">
        <header class="w3-container w3-padding-32 w3-center w3-cyan">
            <h1 class="w3-text-white">
                <i class="fa fa-shield"></i> PAINEL DE ADMINISTRAÇÃO
            </h1>
            <h2 class="w3-text-white">SISTEMA DE CURRÍCULOS</h2>
            <p class="w3-text-white w3-large">Bem-vindo(a), <?php echo htmlspecialchars($administrador->getNome()); ?>!</p>
        </header>
        
        <div class="w3-content" style="max-width:1000px; margin-top: 50px;">
            <div class="w3-row-padding">
                <div class="w3-col l6 m6 s12 w3-margin-bottom">
                    <div class="w3-card-4 w3-white w3-round-large card-hover">
                        <div class="w3-container w3-cyan w3-padding">
                            <h3><i class="fa fa-users"></i> Usuários</h3>
                        </div>
                        <div class="w3-container w3-padding-32 w3-center">
                            <i class="fa fa-address-book w3-jumbo w3-text-cyan"></i>
                            <h4>Usuários Cadastrados</h4>
                            <p class="w3-text-grey">Visualize e gerencie todos os usuários cadastrados no sistema</p>
                            <form action="../Controller/Navegacao.php" method="post">
                                <button name="btnListarCadastrados" class="w3-button w3-cyan w3-round-large w3-large">
                                    <i class="fa fa-list"></i> Ver Usuários
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w3-col l6 m6 s12 w3-margin-bottom">
                    <div class="w3-card-4 w3-white w3-round-large card-hover">
                        <div class="w3-container w3-blue w3-padding">
                            <h3><i class="fa fa-bar-chart"></i> Estatísticas</h3>
                        </div>
                        <div class="w3-container w3-padding-32 w3-center">
                            <i class="fa fa-pie-chart w3-jumbo w3-text-blue"></i>
                            <h4>Dashboard</h4>
                            <p class="w3-text-grey">Relatórios e estatísticas do sistema (em breve)</p>
                            <button class="w3-button w3-light-grey w3-round-large w3-large" disabled>
                                <i class="fa fa-lock"></i> Em Desenvolvimento
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3-center w3-margin-top w3-margin-bottom">
                <form action="../Controller/Navegacao.php" method="post">
                    <button name="btnLogout" class="w3-button w3-red w3-round-large w3-large">
                        <i class="fa fa-sign-out"></i> Sair do Sistema
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <footer class="w3-container w3-padding-16 w3-center w3-cyan w3-margin-top">
        <p class="w3-text-white">Sistema de Currículos - Painel Administrativo © 2025</p>
    </footer>
</body>
</html>