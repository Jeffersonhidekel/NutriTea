<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $cpf   = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$nome || !$email || strlen($cpf) !== 11 || strlen($senha) < 8) {
        die("Dados inválidos ou formulário preenchido incorretamente.");
    }

    // Hash seguro da senha (RNF06)
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO TUTOR (NOME, e_mail, cpf, Login, Senha, Data_Cadastro) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$nome, $email, $cpf, $email, $senhaHash]);

        header("Location: Login.html?cadastro=sucesso");
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar tutor: " . $e->getMessage());
    }
}
?>