<?php
require_once "conexao/conet.php";
$sql_tarefa = "SELECT * FROM tarefas ORDER BY data_tarefa DESC";
$query_tarefa = $con->prepare($sql_tarefa);
$query_tarefa->execute();
$results_tarefa = $query_tarefa->fetchAll(PDO::FETCH_OBJ);
$contar_tarefa = $query_tarefa->rowCount();
if (isset($contar_tarefa) && $contar_tarefa > 0) {
    foreach ($results_tarefa as $Lista_tarefa) :
        echo "
                <ul  class=' row' id='lista'>
                    <div class='border text-light mt-2 py-0 col-md-7'><span>" . ucfirst($Lista_tarefa->tarefa) . "</span> </div> <div class='col-md-5'> 
                    ";
                    if($Lista_tarefa->feito == 1 ){
                        echo "
                        <a href=executar.php?id=".$Lista_tarefa->id." class='btn btn-sm btn-success pt-1 mr-2'>Do</a>";
                    } else{
                        echo "
                        <a href=executar.php?id_fazer=".$Lista_tarefa->id." class='btn btn-sm btn-secondary pt-1 mr-2 text-center'>Done</a>";
                    }
                  
                   echo " &nbsp;<a href=remover.php?id=".$Lista_tarefa->id." class='btn btn-sm btn-warning pt-1 '>Del</a> <a href=formTarefa.php?id=".$Lista_tarefa->id." class='btn btn-sm btn-warning pt-1 '>Edit</a></div> 
                </ul>
            ";
    endforeach;
} else {
    echo "<p class='text-light text-center'>Sem Tarefa</p>";
}
// <a href='' class='btn btn-sm btn-success'>Feito</a>