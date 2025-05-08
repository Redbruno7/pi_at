<?php
$pdo = new PDO('mysql:host=localhost;dbname=bruno_events', 'root', '12345678@');
$stmt = $pdo->query("SELECT ID_part, nome FROM participantes");

echo "<h2>Lista de Inscritos</h2><ul>";
while ($linha = $stmt->fetch()) {
  echo "<li><a href='perfil.php?id={$linha['id']}'>{$linha['nome']}</a></li>";
}
echo "</ul>";
?>
