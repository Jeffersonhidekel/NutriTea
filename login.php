<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($login) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    $stmt = $pdo->prepare("SELECT * FROM TUTOR WHERE Login = ? OR e_mail = ?");
    $stmt->execute([$login, $login]);
    $tutor = $stmt->fetch();

    if ($tutor && password_verify($senha, $tutor['Senha'])) {
        $_SESSION['tutor_id']   = $tutor['ID'];
        $_SESSION['tutor_nome'] = $tutor['NOME'];

        header("Location: principal.html");
        exit;
    } else {
        echo "<script>alert('Login ou senha incorretos.'); window.location.href='Login.html';</script>";
    }
}
?>