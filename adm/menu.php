<?php
if(!defined('ACCESS')){
    header("Location: /");
    die("Erro: Pagina nao encontrada!<br>");
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="painelAdm.php"> ADM Desconecta </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">***</span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="painelAdm.php">ADM OOO</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="list-payment.php">sTaTuS Pagamentos</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="todosUsuarios.php">USUARIOS</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="todosGuias.php">GUIAS</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="listadeEventos.php">Eventos</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="cad-ponto-turistico.php">Cadastro Ponto Turistico</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="todosPagamentos.php">Pagamentos</a>
                </li>

            </ul>
        </div>
        <a href="logout.php" class="btn btn-danger my-2 my-sm-0">Sair</a>
    </div>
</nav>
