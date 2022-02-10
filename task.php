<?php
include_once "config.php";
$conaction = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conaction){
    throw new Exception("Cannot connect to databas");
}else{
    $action = $_POST['action']?? '';
    if(! $action){
        header('location: index.php');
        die();
    }else{
        if($action == "add"){
            $task = $_POST['task'];
            $date = $_POST['date'];
            if($task && $date){
                $insert_query = "INSERT INTO ".DB_TABLE."(task, date) VALUES('{$task}', '{$date}')";
               mysqli_query($conaction, $insert_query);
               header('location: index.php?added=true');
            }
            
        }

    }

    
}