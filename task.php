<?php

session_start();

// Inicialize $_SESSION['tasks'] como um array se ainda não estiver definido
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

$file_name = null; // Defina $file_name como null por padrão

if (isset($_POST['task_name'])){
    if ($_POST['task_name'] != ""){

        if(isset($_FILES['task_image'])){
            $ext = strtolower(substr($_FILES['task_image']['name'], -4));
            $file_name = md5(date('Y.m.d.H.i.s')) .$ext;
            $dir = 'uploads/';

            move_uploaded_file($_FILES['task_image']['tmp_name'], $dir.$file_name);

        }

        $data = [
            'task_name' => $_POST['task_name'],
            'task_description' => $_POST['task_description'],
            'task_date' => $_POST['task_date'],
            'task_image' => $file_name
        ];

        // Verifique se $_SESSION['tasks'] é um array antes de adicionar $data a ele
        if (is_array($_SESSION['tasks'])) {
            array_push($_SESSION['tasks'], $data);
        } else {
            $_SESSION['tasks'] = array($data); // Se não for um array, inicialize como um array com $data
        }

        unset($_POST['task_name']);
        unset($_POST['task_description']);
        unset($_POST['task_date']);

        header('location:index.php');
    }
    else{
        $_SESSION['message'] = "O campo não pode ser vazio";
        header('location:index.php');
    }
    
}

if (isset($_GET['key'])){
    array_splice($_SESSION['tasks'], $_GET['key'], 1);
    unset($_GET['key']);
    header('location:index.php');
}
