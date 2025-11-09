<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cadastro Realizado</title>
    <style>
        .success-animation {
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="w3-light-grey">
    <div class="w3-display-middle w3-card-4 w3-white w3-round-large success-animation" style="width: 400px; padding: 40px;">
        <div class="w3-center">
            <i class="fa fa-check-circle w3-text-green" style="font-size: 80px;"></i>
            <h2 class="w3-text-green">Cadastro Realizado!</h2>
            <p class="w3-text-grey">Seu cadastro foi realizado com sucesso.</p>
            <p class="w3-text-grey">Você será redirecionado em instantes...</p>
            
            <div class="w3-light-grey w3-round-large w3-margin-top">
                <div class="w3-green w3-round-large" id="progressBar" style="height:24px;width:0%"></div>
            </div>
            
            <p class="w3-margin-top">
                <a href="../View/VisualizarCadastro.php" class="w3-button w3-green w3-round-large">
                    <i class="fa fa-arrow-right"></i> Ir para meu currículo
                </a>
            </p>
        </div>
    </div>
    
    <script>
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
                window.location.href = '../View/VisualizarCadastro.php';
            } else {
                width += 2;
                document.getElementById('progressBar').style.width = width + '%';
            }
        }, 40);
    </script>
</body>
</html>