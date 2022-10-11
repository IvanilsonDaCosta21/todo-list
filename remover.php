
<?php
require_once "conexao/conet.php";

$id_tarefa = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if (isset($id_tarefa)) {

    $sql_tarefa = "DELETE FROM tarefas WHERE id = ?";
    $stmt_tarefa = $con->prepare($sql_tarefa);

    try {
        $stmt_tarefa->execute([$id_tarefa]);
        header('Location:index.php?deleted');
    } catch (Exception $e) {
        echo "Erro";
    }
} else {
    header('Location:index.php?del_ag');
}

?>