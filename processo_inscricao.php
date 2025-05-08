<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bruno_events', 'root', '12345678@');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO participantes (cpf, nome, email, senha, telefone, endereco, cidade, estado, pais, titulacao, instituicao)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['cpf'],
        $_POST['nome'],
        $_POST['email'],
        password_hash($_POST['senha'], PASSWORD_DEFAULT),
        $_POST['telefone'],
        $_POST['endereco'],
        $_POST['cidade'],
        $_POST['estado'],
        $_POST['pais'],
        $_POST['titulacao'],
        $_POST['instituicao']
    ]);

    echo "✅ Registro efetuado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao registrar: " . $e->getMessage();
}
?>