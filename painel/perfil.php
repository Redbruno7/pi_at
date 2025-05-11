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

// Verifica se o ID foi passado pela URL
if (!isset($_GET['ID_part'])) {
    die("ID do participante não fornecido.");
}

$id = intval($_GET['ID_part']);

// Consulta o participante específico
$sql = "SELECT * FROM participantes WHERE ID_part = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se encontrou o participante
if ($resultado->num_rows === 0) {
    die("Participante não encontrado.");
}

$participante = $resultado->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Participante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .info {
      margin-bottom: 10px;
    }
    .label {
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Perfil do Participante</h2>

  <div class="info"><span class="label">Nome:</span> <?= htmlspecialchars($participante['nome']) ?></div>
  <div class="info"><span class="label">CPF:</span> <?= htmlspecialchars($participante['cpf']) ?></div>
  <div class="info"><span class="label">Email:</span> <?= htmlspecialchars($participante['email']) ?></div>
  <div class="info"><span class="label">Telefone:</span> <?= htmlspecialchars($participante['telefone']) ?></div>
  <div class="info"><span class="label">Endereço:</span> <?= htmlspecialchars($participante['endereco']) ?></div>
  <div class="info"><span class="label">Cidade:</span> <?= htmlspecialchars($participante['cidade']) ?></div>
  <div class="info"><span class="label">Estado:</span> <?= htmlspecialchars($participante['estado']) ?></div>
  <div class="info"><span class="label">País:</span> <?= htmlspecialchars($participante['pais']) ?></div>
  <div class="info"><span class="label">Titulação:</span> <?= htmlspecialchars($participante['titulacao']) ?></div>
  <div class="info"><span class="label">Instituição:</span> <?= htmlspecialchars($participante['instituicao']) ?></div>

  <a href="index.php" class="btn btn-primary mt-4">← Voltar à Lista</a>
</div>

</body>
</html>
