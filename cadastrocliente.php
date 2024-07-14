<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do aluno</title>
    <?php include ('./conectaBD.php')?>
    <style>
  header { 
        background-color:rgba(114, 248, 250, 0.5);
        width: auto;
        padding: 50px;
        margin-top: auto;
        font-family:Arial, Helvetica, sans-serif;
        text-align:start ;
        border-style:groove;
        border: thick groove rgba(98,13,181,0.99);
        border-width: 30px;
        margin-bottom: 10px;
        background-image: url(./imagens/controle.png) ;
        background-repeat: no-repeat;
        background-position:right 50%;
        }
        body {
            background-image: url(imagens/containerfoto.png);
            margin: auto;
            margin-left: 10%;
            margin-right: 10%;
            margin-bottom: auto;
            font-family:Arial, Helvetica, sans-serif;

        }
        table {
            font-style: italic;
            background-color:rgba(189, 189, 255, 0.9);
            border-style:groove;
            border: thick groove rgba(98,13,181,0.99);
            border-width: 30px;
            margin-bottom: 10px;
            font-family:Arial, Helvetica, sans-serif;
        }

        table-1 {
        font-family:Arial, Helvetica, sans-serif;
        background-color:rgba(211, 248, 250, 0.9);
        width: 50px;
        padding: 20px;
        font-family:fantasy;
        text-align: center;
        border-style:groove;
        border: thick groove rgba(98,13,181,0.99);
        border-width: 30px;
        margin-bottom: 10px;
        background-repeat: no-repeat;
        background-position:right 50%;
        }

    </style>
</head>
<body>
    <header>
        <form action="cadastrocliente.php" method="post" name="cliente">
            <table>
                <tr>
                    <td>Digite seu nome</td>
                    <td><input type="text" name="NOME"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="enviar" nome="botao">
                        <input type="reset" value="limpar" nome="botao">
                    </td>
                </tr>
            </table>
            <br><br><br><br><br>
            <table-1>
    <tr>
        <th width="20%">
            <a href="index.php">HOME</a>
        </th>
    </tr>
</table-1>            
        </form>
    </header>
    <?php   if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require ('./conectaBD.php');

            $NOME   = $_POST['NOME'];

        $sql = " INSERT into CLIENTE (NOME)
        VALUES ('$NOME') ";
        if ($result = $mysqli->query($sql)) {
          $msg = "Olhe o relatório e pegue o carro de sua escolha";
        }
        else {
        $msg = "Tente novamente";
    }
        echo $msg;
}

?>



</body>

</html>