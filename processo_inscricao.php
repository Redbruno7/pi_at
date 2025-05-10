<?php
    // Configuração do banco de dados
    $host = 'localhost';  // Endereço do servidor (normalmente 'localhost')
    $dbname = 'bruno_events';  // Nome do banco de dados
    $username = 'root';  // Nome de usuário do banco de dados
    $password = '12345678@';  // Senha do banco de dados

    // Criar a conexão com o banco de dados
    $conn = new mysqli($host, $username, $password, $dbname);

    // Verificar se a conexão foi bem-sucedida
    if ($conn->connect_errno) {
        echo "Erro";
    };

    // Verificar se o formulário foi enviado via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar e capturar os dados do formulário
        if (isset($_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone'], 
                $_POST['endereco'], $_POST['cidade'], $_POST['estado'], $_POST['pais'], 
                $_POST['titulacao'], $_POST['instituicao'])) {

            // Sanitizar e armazenar os dados recebidos
            $cpf = trim($_POST['cpf']);
            $nome = trim($_POST['nome']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT); // Senha criptografada
            $telefone = trim($_POST['telefone']);
            $endereco = trim($_POST['endereco']);
            $cidade = trim($_POST['cidade']);
            $estado = trim($_POST['estado']);
            $pais = trim($_POST['pais']);
            $titulacao = trim($_POST['titulacao']);
            $instituicao = trim($_POST['instituicao']);

            // Verificar se os campos estão vazios ou inválidos
            if (empty($cpf) || empty($nome) || empty($email) || empty($senha) || empty($telefone) || 
                empty($endereco) || empty($cidade) || empty($estado) || empty($pais) || empty($titulacao) || 
                empty($instituicao)) {
                echo "Por favor, preencha todos os campos!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "O email fornecido não é válido!";
            } else {
                // Preparar a query para inserção dos dados no banco
                $stmt = $conn->prepare("INSERT INTO participantes (cpf, nome, email, senha, telefone, endereco, cidade, estado, pais, titulacao, instituicao) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $cpf, $nome, $email, $senha, $telefone, $endereco, $cidade, $estado, $pais, $titulacao, $instituicao);

                // Executar a query
                if ($stmt->execute()) {
                    echo "Inscrição realizada com sucesso!";
                } else {
                    echo "Erro ao registrar inscrição: " . $stmt->error;
                }

                // Fechar a declaração preparada
                $stmt->close();
            }
        } else {
            echo "Erro: Todos os campos são obrigatórios!";
        }
    } else {
        echo "Método de requisição inválido!";
    }

    // Fechar a conexão com o banco
    $conn->close();
?>