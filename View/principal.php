<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Enlatados Juarez</title>
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
</style>
</head>
<body class="w3-light-grey">

<nav class="w3-sidebar w3-bar-block w3-center w3-blue w3-collapse" id="mySidebar">
    <a href="#home" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
        <i class="fa fa-home w3-xxlarge"></i>
        <p>HOME</p>
    </a>
    <a href="#dPessoais" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
        <i class="fa fa-address-book-o w3-xxlarge"></i>
        <p>Dados Pessoais</p>
    </a>
    <a href="#formacao" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
        <i class="fa fa-mortar-board w3-xxlarge"></i>
        <p>Formação</p>
    </a>
    <a href="#outrasFormacoes" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
        <i class="fa fa-plus-square w3-xxlarge"></i>
        <p>Outras Formações</p>
    </a>
</nav>

<div class="w3-main" id="main">
    <header class="w3-container w3-padding-32 w3-center" id="home">
        <h1>
            <img src="../Img/Logo.png" alt="Logo" class="w3-image" style="width:25%;">
        </h1>
        <a class="w3-text-cyan" href="http://www.freepik.com">Designed by brgfx / Freepik</a>
        <br>
        <h1 class="w3-text-cyan">SISTEMA DE CURRÍCULOS</h1>
    </header>

    <div class="w3-padding-large w3-content" style="max-width:800px">
        <div id="dPessoais" class="w3-padding-32">
            <h2 class="w3-text-cyan">Dados Pessoais</h2>
            <hr class="w3-opacity">
            <form action="" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-padding-16">
                <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden" value="">
                <div class="w3-row-padding">
                    <div class="w3-section">
                        <label><i class="fa fa-user"></i> Nome Completo</label>
                        <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome Completo" value="">
                    </div>
                </div>
            </form>
        </div>

        <div id="formacao" class="w3-padding-32">
            <h2 class="w3-text-cyan">Formação</h2>
            <hr class="w3-opacity">
            <form action="" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-padding-16">
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <label><i class="fa fa-calendar"></i> Data Inicial</label>
                        <input class="w3-input w3-border w3-round-large" name="txtInicioFA" type="date">
                    </div>
                    <div class="w3-half">
                        <label><i class="fa fa-calendar"></i> Data Final</label>
                        <input class="w3-input w3-border w3-round-large" name="txtFimFA" type="date">
                    </div>
                </div>
                <div class="w3-section">
                    <label><i class="fa fa-align-justify"></i> Descrição</label>
                    <input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text" placeholder="Ex.: Técnico em Desenvolvimento de Sistemas - Centro Paula Souza">
                </div>
                <div class="w3-center">
                    <button name="btnAddFormacao" class="w3-button w3-blue w3-round-large w3-margin-top" style="width:50%;">
                        <i class="fa fa-plus"></i> Adicionar Formação
                    </button>
                </div>
            </form>
            <div class="w3-container w3-padding-16">
                <table class="w3-table-all w3-centered w3-card-4">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div id="outrasFormacoes" class="w3-padding-32">
            <h2 class="w3-text-cyan">Outras Formações</h2>
            <hr class="w3-opacity">
            <form action="" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-padding-16">
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <label><i class="fa fa-calendar"></i> Data Inicial</label>
                        <input class="w3-input w3-border w3-round-large" name="txtInicioOF" type="date">
                    </div>
                    <div class="w3-half">
                        <label><i class="fa fa-calendar"></i> Data Final</label>
                        <input class="w3-input w3-border w3-round-large" name="txtFimOF" type="date">
                    </div>
                </div>
                <div class="w3-section">
                    <label><i class="fa fa-align-justify"></i> Descrição</label>
                    <input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text" placeholder="Ex.: Curso de Inglês Avançado">
                </div>
                <div class="w3-center">
                    <button name="btnAddOF" class="w3-button w3-blue w3-round-large w3-margin-top" style="width:50%;">
                        <i class="fa fa-plus"></i> Adicionar Outra Formação
                    </button>
                </div>
            </form>
            <div class="w3-container w3-padding-16">
                <table class="w3-table-all w3-centered w3-card-4">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>