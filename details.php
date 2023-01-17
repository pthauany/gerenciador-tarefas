<?php

require __DIR__ . '/connect.php';

session_start();

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $_GET['key']);
$stmt->execute();
$data = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="details-container">
        <div class="header">
            <h1><?php echo $data[0]['task_name'];?></h1>
        </div>
        <div class="row">
            <div class="details">
                <dl>
                    <dt>Descriçãp da tarefa:</dt>
                    <dd><?php echo $data[0]['task_description'];?></dd>
                    <dt>Data da tarefa:</dt>
                    <dd><?php echo $data[0]['task_date'];?></dd>

                </dl>
            </div>
            <div class="image">
                <img src="uploads/<?php echo $data[0]['task_image'];?>" alt="Imagem tarefa">
            </div>
        </div>
        <div class="footer">
            <p>Desenvolvido por Thauany</p>
        </div>
    </div>

</body>
</html>