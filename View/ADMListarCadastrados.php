<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Usuários Cadastrados</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        .btn-visualizar {
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        .btn-visualizar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .table-container {
            overflow-x: auto;
        }
        tr:hover {
            background-color: #f1f1f1 !important;
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
    
    include_once '../Model/Usuario.php';
    $administrador = unserialize($_SESSION['Administrador']);
    ?>
    
    <header class="w3-container w3-padding-32 w3-center w3-cyan">
        <h1 class="w3-text-white">
            <i class="fa fa-users"></i> Lista de Usuários Cadastrados no Sistema
        </h1>
        <p class="w3-text-white">Administrador: <?php echo htmlspecialchars($administrador->getNome()); ?></p>
    </header>
    
    <div class="w3-content" style="max-width:1200px; margin-top:30px;">
        <div class="w3-card-4 w3-white">
            <div class="w3-container w3-cyan w3-padding">
                <h3><i class="fa fa-list"></i> Usuários Registrados</h3>
            </div>
            
            <div class="w3-container w3-padding table-container">
                <table class="w3-table-all w3-hoverable w3-centered">
                    <thead>
                        <tr class="w3-blue">
                            <th style="width: 10%;"><i class="fa fa-hashtag"></i> Código</th>
                            <th style="width: 50%;"><i class="fa fa-user"></i> Nome</th>
                            <th style="width: 40%;"><i class="fa fa-eye"></i> Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuario = new Usuario();
                        $results = $usuario->listaCadastrados();
                        
                        if($results != null && $results->num_rows > 0) {
                            while($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td><strong>' . htmlspecialchars($row->idusuario) . '</strong></td>';
                                echo '<td class="w3-left-align" style="padding-left: 20px;">' . htmlspecialchars($row->nome) . '</td>';
                                echo '<td>';
                                echo '<a href="../View/ADMVisualizarCadastro.php?id=' . $row->idusuario . '" class="w3-button w3-cyan w3-round btn-visualizar">';
                                echo '<i class="fa fa-eye"></i> Visualizar';
                                echo '</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3" class="w3-center w3-text-grey w3-padding-32">';
                            echo '<i class="fa fa-info-circle w3-xxlarge"></i><br><br>';
                            echo 'Nenhum usuário cadastrado no sistema.';
                            echo '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="w3-center w3-margin-top w3-margin-bottom" style="margin-top: 30px;">
            <form action="../View/ADMPrincipal.php" method="post">
                <button type="submit" name="btnVoltar" class="w3-button w3-blue w3-round-large w3-large" style="width: 300px;">
                    <i class="fa fa-arrow-left"></i> Voltar ao Painel
                </button>
            </form>
        </div>
    </div>

    <footer class="w3-container w3-padding-16 w3-center w3-cyan w3-margin-top">
        <p class="w3-text-white">Sistema de Currículos - Painel Administrativo</p>
    </footer>

</body>
</html>