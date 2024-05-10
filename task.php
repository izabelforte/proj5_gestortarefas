<?php

session_start();

// Inicialize $_SESSION['tasks'] como um array se ainda não estiver definido
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    //verifica se os campos não estão vazios
    if (!empty($_POST['task_name']) && !empty($_POST['task_description']) && !empty($_POST['task_date']) && isset($_POST['task_color'])){


        $data = [
            'task_name' => $_POST['task_name'],
            'task_description' => $_POST['task_description'],
            'task_date' => $_POST['task_date'],
            'task_color' => $_POST['task_color']
        ];

     // Inicializa $_SESSION['tasks'] como um array se ainda não estiver definido
     if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = array();
    }

    // Adiciona a nova tarefa ao array $_SESSION['tasks']
    $_SESSION['tasks'][] = $data;

    // Redireciona para a página inicial
    header('Location: index.php');
    exit(); // Encerra o script após o redirecionamento
} else {
    // Define a mensagem de erro
    $_SESSION['message'] = "Todos os campos devem ser preenchidos.";
}

    
}

if (isset($_GET['key'])){
    array_splice($_SESSION['tasks'], $_GET['key'], 1);
    unset($_GET['key']);
    header('location:index.php');
}
