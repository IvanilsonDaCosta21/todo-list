
<?php
require_once "conexao/conet.php";

// if (isset($_POST)) {
$tarefa = filter_input(INPUT_POST, 'tarefa', FILTER_DEFAULT);
$feito = 1;

if (!empty($_POST['tarefa'])) {


    $sql_tarefa = "INSERT INTO `tarefas` (tarefa, feito,  data_tarefa) VALUES (:tarefa, :feito,  NOW())";

    $stmt_tarefa = $con->prepare($sql_tarefa);
    $stmt_tarefa->bindParam(':tarefa', $tarefa, PDO::PARAM_STR);
    $stmt_tarefa->bindParam(':feito', $feito, PDO::PARAM_INT);

    $inserido_tarefa =  $stmt_tarefa->execute();
    // var_dump($inserido);
    if ($inserido_tarefa) {
        echo json_encode("<div class='text-center alert alert-success my-2' id='msg'> Tarefa Inserida</div>");
    } else {
        echo json_encode("<div class='text-center alert alert-danger my-2' id='msg'> Falha ao Inserir Tarefa</div>");
    }
} else {
    echo json_encode("<div class='text-center alert alert-warning my-2' id='msg'> Campo Vazio</div>");
}

?>