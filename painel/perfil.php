<?php
$pdo = new PDO('mysql:host=localhost;dbname=bruno_events', 'root', '12345678@');
$id = $_GET['ID_part'];

$stmt = $pdo->prepare("SELECT * FROM participantes WHERE ID_part = ?");
$stmt->execute([$id]);
$participante = $stmt->fetch();

if ($participante) {
  echo "<h2>Perfil de {$participante['nome']}</h2>";
  foreach ($participante as $campo => $valor) {
    if ($campo != 'senha') echo "<p><strong>$campo:</strong> $valor</p>";
  }
} else {
  echo "Participante não encontrado.";
}
?>
