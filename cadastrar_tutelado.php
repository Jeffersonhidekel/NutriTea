<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['tutor_id'])) {
    header("Location: Login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome           = trim($_POST['nome_tutelado'] ?? '');
    $dataNascimento = $_POST['data_nascimento'] ?? '';
    $sexo           = $_POST['sexo'] ?? '';
    $grauTea        = (int)($_POST['nivel_suporte'] ?? 1);
    $preferencias   = trim($_POST['preferencias'] ?? '');
    $idTutor        = $_SESSION['tutor_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO TUTELADO (NOME, data_nascimento, sexo, data_cadastro, grau_tea, preferencia_alimentar, id_tutor) VALUES (?, ?, ?, NOW(), ?, ?, ?)");
        $stmt->execute([$nome, $dataNascimento, $sexo, $grauTea, $preferencias, $idTutor]);

        header("Location: principal.html?tutelado=sucesso");
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar tutelado: " . $e->getMessage());
    }
}
?>