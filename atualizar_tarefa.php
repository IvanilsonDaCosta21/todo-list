
<?php
require_once('conexao/conet.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $tarefa = filter_input(INPUT_GET, 'tarefa', FILTER_DEFAULT);
    $id_tarefa = filter_input(INPUT_GET, 'id_tarefa', FILTER_DEFAULT);

    $sql = "UPDATE `tarefas` SET tarefa = ? WHERE id = ?";
    $query = $con->prepare($sql);
    $query->bindParam(1, $tarefa, PDO::PARAM_STR);
    $query->bindParam(2, $id_tarefa, PDO::PARAM_INT);
    // try {
    $result = $query->execute();
    if ($result == true) {
        echo json_encode("<div class='text-center alert alert-success my-2' id='msg'>Tarefa atualizada com sucesso !</div>");
    } else {
        echo json_encode("<div class='text-center alert alert-warning my-2' id='msg'>ERRO: Falha em atualizar tarefa !</div>");
    }
} else {
    echo json_encode("<div class='text-center alert alert-danger my-2' id='msg'> Sem dados !</div>");
}
?>