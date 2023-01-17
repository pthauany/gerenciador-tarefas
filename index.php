<?php

require __DIR__ . '/connect.php';

session_start();

if(!isset($_SESSION['tasks'])){
    $_SESSION['tasks'] = array();
}

if(isset($_GET['clear'])){
    unset($_SESSION['tasks']);
}

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt ->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de tarefas</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
            if(isset($_SESSION['success'])){
        ?>
            <div class="alert-success"><?php echo $_SESSION['success'];?></div>
        <?php
        unset($_SESSION['success']);
            }
        ?>
        <?php
            if(isset($_SESSION['error'])){
        ?>
            <div class="alert-error"><?php echo $_SESSION['error'];?></div>
        <?php
        unset($_SESSION['error']);
            }
        ?>
        <div class="header">
            <h1>Gerenciador de Tarefas
        </div>
        <div class="form">
            <form action="task.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="insert" value="insert">
                <label for="task_name">Tarefa:</label>
                <input type="text" name="task_name" placeholder="Nome da tarefa">
                <label for="task_description">Descrição:</label>
                <input type="text" name="task_description" placeholder="Descrição da tarefa">
                <label for="task_date">Data:</label>
                <input type="date" class="task_date">
                <label for="task_image">Imagem:</label>
                <input type="file" name="task_image">
                <button type="submit">Cadastrar</button>
            </form>
            <?php
                if(isset($_SESSION['message'])){
                echo "<p style='color: #de3535'; >" . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']);
                }
            ?>
        </div>
        <div class="separator">

        </div>
        <div class="list-tasks">
            <?php

                echo "<ul>";
                    foreach($stmt->fetchAll() as $task){
                    echo "<li>
                        <a href='details.php?key=" . $task['id'] . "'>" . $task['task_name'] . "</a>
                        <button type='button' class='btn-clear' onclick='deletar".$task['id']."()'>Remover</button>
                        <script>
                            function deletar".$task['id']."(){
                                if(confirm('Confirmar remoção?')){
                                    window.location = 'http://localhost:8100/task.php?key=".$task['id']."';
                                }
                                return false;
                            }
                        </script>
                        </li>";
                    }
                echo "</ul>";
            
            ?>
            <ul>
            <form action="" method="get">
                <input type="hidden" name="clear" value="clear">
                <button type="submit" class="btn-clear" >Limpar Tarefas</button>
            </form>    
        </div>
        <div class="footer">
            <p>Desenvolvido por Thauany</p>
        </div>
    </div>
    
</body>
</html>