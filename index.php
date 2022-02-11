<?php
include_once "config.php";
$conaction = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conaction){
    throw new Exception("Cannot connect to databas");
}
$query = "SELECT * FROM tasks";
$result = mysqli_query($conaction, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container main-container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                    <h1>Task Manager</h1>
                    <p>MY Task Management Dashboard, You can change your all task information hare</p>
                    <h3>All Task</h3>
                    <?php
                        if(mysqli_num_rows($result)==0){
                            echo "Task is Not Found!";
                        }
                    ?>
                    <hr>
                        <form>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Task</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($data = mysqli_fetch_assoc($result)):
                                        $timestamp = strtotime($data['date']);
                                        $date = date("jS, M, Y", $timestamp);

                                    ?>  
                                    <tr>
                                        <td><input class="label-inline" type="checkbox" value="<?php echo $data['id']?>"></td>
                                        <td><?php echo $data['id']?></td>
                                        <td><?php echo $data['task']?></td>
                                        <td><?php echo $date ?></td>
                                        <td><a href="#">Delete</a> | <a href="#">Complite</a></td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                        mysqli_close($conaction);
                                    ?>
                                </tbody>
                            </table>
                            <select name="" id="action">
                                <option value="0">With Select</option>
                                <option value="del">Delete</option>
                                <option value="complite">Mark as Complite</option>
                            </select>
                            <input class="button-primary" type="submit" value="Submit">
                        </form>
                    <hr>
            </div>
        </div>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h4>Add Tasks</h4>
                <?php
                    $add_task = $_GET['added']?? '';
                    if("true"==$add_task){
                        echo "<blockquote>The Task is Successfully Added</blockquote>";
                    }
                ?>
                <form action="task.php" method="POST">
                    <fieldset>
                        <label for="task">Task</label>
                        <input type="text" name="task" id="task" placeholder="Task Details">
                        <label for="date">Date</label>
                        <input type="text" name="date" id="date" placeholder="Task Date">
                        <input class="button-primary" type="submit" value="submit">
                        <input type="hidden" name="action" value="add">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>