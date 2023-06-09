<?php
        //Criptografar a senha
        $password_encrypted = password_hash("123456a", PASSWORD_DEFAULT);
        //echo $password_encrypted;
        
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
                $query_user = "SELECT id, email, nome, senha FROM servicos WHERE email =:email LIMIT 1";
                $result_user = $conn->prepare($query_user);
                $result_user->bindParam(':email', $data['email']);
                $result_user->execute();
                if($result_user->rowCount() != 0){
                
                    $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
                    $msg = $data['senha'];
                    //Verificar a senha
                    if(password_verify($data['senha'], $row_user['senha'])){
                        $msg = "<div class='alert alert-success' role='alert'>Usuário e senha valida!</div>";
                        //aqui usuario turista acessa painel 

                        $_SESSION['user_id'] = $row_user['id'];
                        $_SESSION['user_name'] = $row_user['nome'];
                        $_SESSION['user_email'] = $row_user['email'];
                        $_SESSION['user_key'] = password_hash($row_user['id'], PASSWORD_DEFAULT);
                        $msg = "<div class='alert alert-success' role='alert'>Entrou!</div>";
                        header("Location: painelGuia.php");
                        
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
       <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11" style="margin: 20px; padding-left: 10px; padding-right: 20px;">

        <form method="POST" action="" class="form-signin">
            <div class="text-center mb-4">
                <img class="mb-4" src="../LG2.png" alt="" width="72" height="72">
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
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" value="<?php if(isset($data['senha'])){ echo $data['senha']; } ?>">
                
            </div>
            <br/>

            <button type="submit" name="BtnLogin" class="btn btn-lg btn-primary btn-block" id="<?php echo $id; ?>" value="BtnLogin">Acessar</button> 
        </form>

        </div> 
     </div><!-- Fim da ROW -->