<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teste</title>
</head>
<body>
    <h2>trabalhando com php<h2>
    <?php
        $nome='osnir';
        $operadora='claro';

        if($operadora=='claro'){
            echo'não usar,operadora problemática!';
        }else{
            echo'vai na fé!';
        }

        echo"<h1> olá mundo!bem-vindo $nome</h1>";
        for($contador=0;$contador <10; $contador++){
            echo $contador;
            echo'<img src="">';
        }
        ?>
</body>
</html>