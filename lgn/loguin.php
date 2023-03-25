
<!-- Classe LOGUIN Não utilizada mais apens de lembrança 23/08/2022-->

<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/LG.jpg" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">
        <title>Desconect4 - Login TURISTA</title>
    </head>
    <body>
        <?php
                
        //Receber os dados do formulário
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Variável para receber a mensagem de erro ou sucesso
        $msg = "";

        // Acessar o IF quando o usuário clica no botão
        if (isset($data['BtnLogin'])) {
            $empty_input = false;
            $data = array_map('trim', $data);
            if (in_array("", $data)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher todos os campos!</div>";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher com e-mail válido!</div>";
            }

            // Acessa o IF quando não há nenhum erro no formulário
            if (!$empty_input) {
                //Pesquisar o usuário BD
                $query_user = "SELECT id, email, name, password FROM turistas WHERE email =:email LIMIT 1";
                $result_user = $conn->prepare($query_user);
                $result_user->bindParam(':email', $data['email']);
                $result_user->execute();
                if($result_user->rowCount() != 0){
                    //$msg = "<div class='alert alert-success' role='alert'>E-mail encontrado!</div>";
                


                    $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
                    $msg = $data['password'];
                    //Verificar a senha
                    if(password_verify($data['password'], $row_user['password'])){
                        $msg = "<div class='alert alert-success' role='alert'>Usuário e senha valida!</div>";
                        //aqui usuario turista acessa painel 

                        $_SESSION['user_id'] = $row_user['id'];
                        $_SESSION['user_name'] = $row_user['name'];
                        $_SESSION['user_email'] = $row_user['email'];
                        $_SESSION['user_key'] = $row_user['password'];
                        $msg = "<div class='alert alert-success' role='alert'>Entrou!</div>";
                        header("Location: ../usuarios/painelUsuario.php");
                        
                    }else{
                        $msg = "<div class='alert alert-danger' role='alert'>Erro: Usuário001 ou a senha incorreta!</div>";
                    }
                }else{
                    $msg = "<div class='alert alert-danger' role='alert'>Erro: Usuário ou a senha incorreta!</div>";
                }
            }
        }
        ?>
        
     <div class="row" >
        <div class="col-md-3" style="margin: auto;">

        <form method="POST" action="" class="form-signin">
            <div class="text-center mb-4">
                <img class="mb-4" src="../images/logo/LG.jpg" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Acesse o Turismo</h1>                
            </div>
            <?php
            if (!empty($msg)) {
                echo $msg;
                $msg = "";
            }
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div class="form-label-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="<?php if(isset($data['email'])){ echo $data['email']; } ?>" autofocus>
                
            </div>

            <div class="form-label-group">
            <label for="password">Senha</label>    
            <input type="text" name="password" id="password" class="form-control" placeholder="Senha" value="<?php if(isset($data['password'])){ echo $data['password']; } ?>">
                
            </div>
            <br/>

            <button type="submit" name="BtnLogin" class="btn btn-lg btn-primary btn-block" id="<?php echo $id; ?>" value="BtnLogin">Acessar</button> 
        </form>

    </div>  



            <!-- SEGUNDO FORM DE LOGUIN PARA GUIAS -->
            
            <?php
            // Acessar o IF quando o usuário clica no botão
        if (isset($data['BtnLogin'])) {
            $empty_input = false;
            $data = array_map('trim', $data);
            if (in_array("", $data)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher todos os campos!</div>";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher com e-mail válido!</div>";
            }

            // Acessa o IF quando não há nenhum erro no formulário
            if (!$empty_input) {
                //Pesquisar o usuário BD
                $query_user = "SELECT id, email, nome, senha FROM servicos WHERE email =:email LIMIT 1";
                $result_user = $conn->prepare($query_user);
                $result_user->bindParam(':email', $data['email']);
                $result_user->execute();
                if($result_user->rowCount() != 0){
                    //$msg = "<div class='alert alert-success' role='alert'>E-mail encontrado!</div>";
                   



                    $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
                    $msg = $data['senha'];
                    //Verificar a senha
                    if(password_verify($data['senha'], $row_user['senha'])){
                        $msg = "<div class='alert alert-success' role='alert'>Usuário e senha valida!</div>";


                        $_SESSION['user_id'] = $row_user['id'];
                        $_SESSION['user_nome'] = $row_user['nome'];
                        $_SESSION['user_email'] = $row_user['email'];
                        $_SESSION['user_key'] = password_hash($row_user['id'], PASSWORD_DEFAULT);
                        $msg = "<div class='alert alert-success' role='alert'>Entrou!</div>";
                        header("Location: ../guias/painelGuia.php");
                        
                    }else{
                        $msg = "<div class='alert alert-danger' role='alert'>Erro: Usuário001 ou a senha incorreta!</div>";
                    }
                }else{
                    $msg = "<div class='alert alert-danger' role='alert'>Erro: Usuário ou a senha incorreta!</div>";
                }
            }
        }
        ?>




    <div class="col-md-3" style="margin: auto;">

            <form method="POST" action="" class="form-signin">
                <div class="text-center mb-4">
                    <img class="mb-4" src="../images/logo/LG.jpg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Acesse o Turismo</h1>                
                </div>
                <?php
                if (!empty($msg)) {
                    echo $msg;
                    $msg = "";
                }
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <div class="form-label-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="<?php if(isset($data['email'])){ echo $data['email']; } ?>" autofocus>
                    <label for="email">E-mail</label>
                </div>

                <div class="form-label-group">
                    <input type="text" name="senha" id="senha" class="form-control" placeholder="Senha" value="<?php if(isset($data['senha'])){ echo $data['senha']; } ?>">
                    <label for="password">Senha</label>
                </div>

                <button type="submit" name="BtnLogin" class="btn btn-lg btn-primary btn-block" id="<?php echo $id; ?>" value="BtnLogin">Acessar</button> 
            </form>

        </div>
    </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    </body>
</html>
