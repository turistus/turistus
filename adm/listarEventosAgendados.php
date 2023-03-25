<?php



include_once '../adm/connection.php';
include_once '../adm/validate.php';

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_usuario = "SELECT *, prod.name AS nPt, Ev.nome AS nEvento, svcs.nome AS nGuia, Ev.descricao AS descr, Ev.id AS idV FROM eventos Ev LEFT JOIN pontosturisticos AS prod ON prod.id=Ev.idPt 
                                                                                INNER JOIN servicos AS svcs ON svcs.id=Ev.idGuia ORDER BY Ev.id
                                             LIMIT $inicio, $qnt_result_pg";
$resultados_usuario = mysqli_query($conn, $result_usuario);


//Verificar se encontrou resultado na tabela "usuarios"
if(($resultados_usuario) AND ($resultados_usuario->num_rows != 0)){
	?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr style="background-color: grey;">
                        <th scope="col">ID</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Descrição</th>
                        <th scope="col"> Valor SOMADO </th>
                        <th scope="col">Nome Guia</th>
                        <th scope="col">Ponto turistico</th>
                        <th scope="col"><h4 style="width: 100px;">Data hora </h4></th>
                        <th scope="col">Ações</th>

                        <!-- <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Ações</th>
                        <th scope="col" class="text-center">Guia Nativo</th> -->
			</tr>
		</thead>
		<tbody>

			<?php
			while($row_evento = mysqli_fetch_assoc($resultados_usuario)){
				?>
                <tr>
                    
                    <th><?php echo $row_evento['idV'];?></th>
                    <td><?php echo $row_evento['nEvento'];?></td>
                    <td><?php echo $row_evento['descr'];?></td>
                    <td>R$ <?php echo $row_evento['valor'];?></td>
                    <td><?php echo $row_evento['nGuia'];?></td>
                    <td><?php echo $row_evento['nPt'];?></td>
                    <td><?php echo $row_evento['datah'];?></td>
                    <td>Editar<br>Excluir</td>
            
                   
				</tr>
            
				<?php
			}?>
		</tbody>
	</table>



<?php
        //Paginação - Somar a quantidade de usuários
                $result_pg = "SELECT COUNT(id) AS num_result FROM eventos
                ";
                $resultado_pg = mysqli_query($conn, $result_pg);
                $row_pg = mysqli_fetch_assoc($resultado_pg);

        //Quantidade de pagina
        $quantpag = ceil($row_pg['num_result'] / $qnt_result_pg);
        $quantidade_pg = isset($quantpag);
        
        //Limitar os link antes depois
        $max_links = 2;

        //echo $row_pg['num_result'];

                    echo "<a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a> ";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#' onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
            }
        }

        
        
        
                    echo " $pagina ";



        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $quantidade_pg){
                echo " <a href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
            }
        }

                    echo " <a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</a>";

        } else{
       
            echo "<div class='alert alert-danger' role='alert'>Nenhum evento encontrado!</div>";
            echo " <a href='#' onclick='listar_usuario(1, $qnt_result_pg)'> VOLTAR  </a> ";
        }

        