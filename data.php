<?php
include_once "config.php";

$conaction = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conaction){
    throw new Exception("Cannot connect to databas");
}else{
    echo "database is connected";
    //INSERT INTO tasks (task, date) VALUES ("Do some Thing", "2022-10-10");
    //mysqli_query($conaction,"INSERT INTO tasks (task, date) VALUES ('Do some Thing', '2022-10-10')");
    //mysqli_query($conaction,"INSERT INTO tasks (task, date) VALUES ('Do Everithing Thing', '2022-10-11')");

    $result = mysqli_query($conaction, "SELECT * FROM tasks");

    while($data = mysqli_fetch_assoc($result)){
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    }
    
}