<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Administrador</title>
</head>
<body class="w3-light-grey">
    <form action="../Controller/Navegacao.php" method="post" class="w3-container w3-card-4 w3-white w3-text-blue w3-margin w3-display-middle w3-round-large" style="width: 400px; padding: 30px;">
        <div class="w3-center w3-margin-bottom">
            <i class="fa fa-shield w3-xxxlarge w3-text-cyan"></i>
            <h2 class="w3-text-cyan">Administrador</h2>
            <p class="w3-text-grey">Acesso restrito ao painel administrativo</p>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:11%">
                <i class="w3-xxlarge fa fa-user"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="txtLoginADM" type="text" placeholder="CPF (ex.: 22222222222)" maxlength="11" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:11%">
                <i class="w3-xxlarge fa fa-lock"></i>
            </div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="txtSenhaADM" type="password" placeholder="Senha" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-center">
                <button name="btnLoginADM" class="w3-button w3-block w3-cyan w3-round-large w3-large" style="width: 100%;">
                    <i class="fa fa-sign-in"></i> Entrar
                </button>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-center">
                <a href="../index.php" class="w3-button w3-block w3-light-grey w3-round-large" style="width: 100%;">
                    <i class="fa fa-arrow-left"></i> Voltar ao Login
                </a>
            </div>
        </div>
    </form>
</body>
</html>