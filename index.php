<?php
session_start();


if (!isset($_SESSION['tasks']) ) {
    $_SESSION['tasks'] = array();
}

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
                <label for="task-image">Imagem:</label>
                <input type="file" name="task-image">
                <?php 
                if(isset($_SESSION['message'])){
                    echo "<p style= 'color: #EF5350;'>" .$_SESSION['message']."</p>";
                    unset($_SESSION['message']);
                }
                ?>
                <button type="submit">Agendar</button>

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

                    $difference = $taskDate->diff($today);
                    echo "<li onclick='expandirInfo(this)'>
                        <span>" . $task['task_name']. "</span>
                        <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                        <div class='info-container' style='display: none;'>
                            
                            <p>Descrição: " . $task['task_description'] . "</p>
                            <p>Data: " . $task['task_date'] . "</p>
                            <p>Falta: ".$difference->format('%a dias'). "</p> <!-- Formata a diferença para exibir apenas o número de dias -->
                        </div>
                        <script>
                            function deletar$key(){
                                if (confirm('Confirmar remoção?')) {
                                    window.location = 'http://localhost/proj5_gestortarefas/task.php?key=$key';
                                }
                                return false;
                            }
        
                            function expandirInfo(element) {
                                var infoContainer = element.querySelector('.info-container');
                                if (infoContainer.style.display === 'none') {
                                    infoContainer.style.display = 'block';
                                } else {
                                    infoContainer.style.display = 'none';
                                }
                            }
                        </script>
                    </li>";
                }
                echo "</ul>";
            }
            ?>
            <form action="" method="get">
                <input type="hidden" name="clear" value="clear" >
                <button type="submit" class="btn-clear" >Limpar Tarefas</button>
            </form>
        
        </div>
        <div class="footer">
        <p>Desenvolvido por </p>
        </div>
    </div>
</body>

</html>