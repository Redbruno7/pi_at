<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '12345678@';
$banco = 'bruno_events';

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta os participantes
$sql = "SELECT ID_part, nome FROM participantes ORDER BY nome ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Painel de Inscritos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      padding: 20px;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
    }
    ul {
      max-width: 600px;
      margin: auto;
    }
  </style>
</head>
<body>

  <h1>Lista de Inscritos</h1>

  <ul class="list-group">
    <?php
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            echo '<li class="list-group-item">';
            echo '<a href="perfil.php?ID_part=' . $linha['ID_part'] . '">' . htmlspecialchars($linha['nome']) . '</a>';
            echo '</li>';
        }
    } else {
        echo '<li class="list-group-item">Nenhum inscrito encontrado.</li>';
    }

    $conn->close();
    ?>
  </ul>
</body>
</html>