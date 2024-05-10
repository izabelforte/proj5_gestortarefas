<?php
session_start();

//inicializa o array
if (!isset($_SESSION['tasks']) ) {
    $_SESSION['tasks'] = array();
}

//codigo para limpar todas as tarefas
if (isset($_GET['clear'])){
    unset($_SESSION['tasks']);
    unset($_GET['clear']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Gestor de tarefas</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Gestor de tarefas</h1>
        </div>
        <div class="form">
            <form action="task.php" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="insert" value="insert">
                <label for="task">Tarefa: </label>
                <input type="text" name="task_name" placeholder="Nova tarefa">
                <label for="task_description">Descrição: </label>
                <input type="text" name="task_description" placeholder="Descrição da tarefa" >
                <label for="task_date">Data: </label>
                <input type="date" name="task_date">
                <label for="task_color">Cor de Fundo:</label><br>
                <?php 
                //mensagem se os campos estiverem vazios
                if(isset($_SESSION['message'])){
                    echo "<p style= 'color: #EF5350;'>" .$_SESSION['message']."</p>";
                    unset($_SESSION['message']);
                }
                ?>
                <div class="cores-input" >
                
                <input type="radio" name="task_color" value="#f3858e" checked> Rosa <br>
                <input type="radio" name="task_color" value="#5081DA"> Azul<br>
                <input type="radio" name="task_color" value="#ffff97"> Amarelo<br>
                <input type="radio" name="task_color" value="#fbae4a"> Laranja<br>
                <input type="radio" name="task_color" value="#eaec40"> Verde<br>
                
                </div>
                <div class="form-btn">
                <button type="submit" class="btn-agendar">Agendar</button>
                <button type="submit" class="btn-mostrar">Mostrar</button>
                </div>
                
            </form>
            
        </div>
        <div class="separator">

        </div>
        <div class="list-tasks">
            <?php 
            $today = new DateTime();
            if(isset($_SESSION['tasks'])) {
                echo "<ul>";
                foreach ($_SESSION['tasks'] as $key => $task) {
                    $taskDate = new DateTime($task['task_date']); // Cria um objeto DateTime para a data da tarefa
                    $color = $task['task_color'];
                    $difference = $taskDate->diff($today);
                    echo "<li onclick='expandirInfo(this); exibirAlerta(\"Texto do alerta\");' style='background-color: $color;'>
                        <span>" . $task['task_name']. "</span>
                        
                        <div class='info-container' style='display: none;'>
                            
                            <p>Descrição: " . $task['task_description'] . "</p>
                            <p>Data: " . $task['task_date'] . "</p>
                            <p>Em: ".$difference->format('%a dias'). "</p> <!-- Formata a diferença para exibir apenas o número de dias -->
                            <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                        </div>
                        <script>function deletar$key(){
                            if (confirm('Confirmar remoção?')) {
                                window.location = 'http://localhost/proj5_gestortarefas/task.php?key=$key';
                            }
                            return false;
                        }
                        </script>
                    </li>";
                }
                echo "</ul>";
            }
            ?>
            <form action="" method="get">
                <input type="hidden" name="clear" value="clear" >
                <button type="submit" class="btn-clear" >Limpar</button>
            </form>
            

        </div>
        <div class="footer">
        <p>Desenvolvido por Izabel Forte</p>
        </div>
    </div>
  
</body>

</html>