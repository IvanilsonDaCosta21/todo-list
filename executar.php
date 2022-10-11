
<?php
require_once('conexao/conet.php');

// if ($_SERVER["REQUEST_METHOD"] == "GET") {
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    $id_tarefa = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    $feito = 0;

    $sql = "UPDATE `tarefas` SET feito = ? WHERE id = ?";
    $query = $con->prepare($sql);
    $query->bindParam(1, $feito, PDO::PARAM_INT);
    $query->bindParam(2, $id_tarefa, PDO::PARAM_INT);

    $result = $query->execute();
    if ($result) {
        echo json_encode("<div class='text-center alert alert-success my-2' id='msg'>Tarefa feita !</div>");
    } else {
        echo json_encode("<div class='text-center alert alert-danger my-2' id='msg'>'ERRO: Falha em executar tarefa !</div>");
    }
} elseif (isset($_GET["id_fazer"]) && !empty($_GET["id_fazer"])) {
    $feito1 = 1;
    $sql = "UPDATE `tarefas` SET feito = ? WHERE id = ?";
    $query = $con->prepare($sql);
    $query->bindParam(1, $feito1, PDO::PARAM_INT);
    $query->bindParam(2, $id_tarefa, PDO::PARAM_INT);

    $result = $query->execute();
    if ($result) {
        echo json_encode("<div class='text-center alert alert-success my-2' id='msg'>Tarefa Desfeita !</div>");
    } else {
        echo json_encode("<div class='text-center alert alert-danger my-2' id='msg'>'ERRO: Falha em executar tarefa !</div>");
    }
} else {
    echo json_encode("<div class='text-center alert alert-danger my-2' id='msg'> Sem dados !</div>");
}
?>