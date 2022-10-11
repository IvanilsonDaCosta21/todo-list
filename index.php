<?php require_once('conexao/conet.php'); ?>
<?php
// COntar Tarefa
$sql_tarefa = "SELECT * FROM tarefas WHERE feito = 1 ";
$query_tarefa = $con->prepare($sql_tarefa);
$query_tarefa->execute();
$results_tarefa = $query_tarefa->fetchAll(PDO::FETCH_OBJ);
$contar_tarefa = $query_tarefa->rowCount(); ?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="descricao" content="Um todo list criado para exercitar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap5/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css">

    <title>Todo List</title>

    <!-- CSS Interno - ( Pregusa di cria ficheiro ) -->
    <style>
        #corpo {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007CCC;


            /* background-image: linear-gradient(to bottom, #007CCC,#0001CC); */
            /* background-repeat: repeat-y;
            background-size: cover;
            background-position: center; */
        }

        #cont {
            margin-top: 50px;
        }

        #caixa {
            background-color: #900505;
            border-radius: 10px;
            box-shadow: 2px 2px 20px black;
        }

        #titulo {
            color: #007CCC;
            border: 1px solid white;
            border-radius: 2px;
            box-shadow: 2px 2px 25px #003ECC;
        }

        /* .lista { */
        /* overflow: auto; */
        /* background-color: white; */
        /* } */
    </style>
</head>

<body id="corpo">

    <div class="container mt-5" id="cont">
        <div class="row justify-content-center">
            <div class="col-md-4" id="caixa">
                <h2 class=" text-center text-warning py-2 my-5" id="titulo">Lista de Tarefas </h2>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <input type="text" id="tarefa" name="tarefa" class="form-control" placeholder="Insira uma tarefa">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="boton">Add</button>
                            </div>
                        </div>
                        <div id="resposta" class="text-center"></div>
                    </div>
                </form>
                <div id="app" class="lista mt-5">

                </div>
                <?php if (isset($contar_tarefa) && $contar_tarefa > 0) : ?>
                    <p class="mt-4 text-center text-light"><b><?= $contar_tarefa ?></b> por realizar !</p>
                <?php else : ?>
                    <p class="mt-4 text-center text-light"><b>Nenhuma</b> tarefa por realizar !</p>
                <?php endif ?>
            </div>
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-md-4 mt-4">
                        <p id="caixa" class="text-light b text-center py-2">Desenvolvido por <span class="h6">CSI</span>
                        <p class="text-light  text-center py-2"><small> Todos Direitos Reservados &copy; <span class="h6"><?= date('Y') ?></span></small></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/sweetalert/sweetalert.all.min.js"></script>

    <script>
        $(document).ready(function() {

            // Mostrar Tarefa
            function mostrar() {
                $.ajax({
                    url: 'mostrar.php',
                    method: 'POST',
                    success: function(data) {
                        $("#app").html(data);
                    }
                });
            }
            mostrar();

            /* Adicionar Tarefa */
            $("#boton").click(function(e) {
                e.preventDefault();

                var tarefa = $('#tarefa').val();
                $.ajax({
                    url: 'tarefa.php',
                    method: 'POST',
                    data: {
                        tarefa: tarefa
                    },
                    dataType: 'JSON',
                    beforeSend: function(data) {
                        $("#resposta").html('<b class="text-center">Aguarde...</b>');
                    },
                    success: function(data) {
                        $("#resposta").html(data);

                        // Atualizar Info momentaneamente
                        mostrar();

                        // Ocultar as caixas de msg
                        setTimeout(function() {
                            $("#resposta").css('display', 'none')
                        }, 3000)

                        // Limpar Campo
                        $('#tarefa').val() = '';


                    },
                    error: function() {
                        $("#resposta").html(data);
                    }
                });
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js"></script>
    <script src="assets/js/alert.js"></script>
</body>

</html>