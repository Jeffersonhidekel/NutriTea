<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['tutor_id'])) {
    header("Location: Login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTutor         = $_SESSION['tutor_id'];
    $idTutelado      = (int)($_POST['tutelado'] ?? 0);
    $idAlimento      = (int)($_POST['alimento'] ?? 0);
    $data            = $_POST['data'] ?? date('Y-m-d');
    $hora            = $_POST['hora'] ?? date('H:i:s');
    $quantidade      = (float)($_POST['quantidade'] ?? 0);
    $reacao          = $_POST['reacao'] ?? '';
    $motivoSensorial = !empty($_POST['motivo_sensorial']) ? $_POST['motivo_sensorial'] : null;

    try {
        $sql = "INSERT INTO REGISTRO 
            (id_Tutelado, id_Tutor, id_Alimento, data, hora, quantidade, reacao, motivo_sensorial) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idTutelado, $idTutor, $idAlimento, $data, $hora, $quantidade, $reacao, $motivoSensorial]);

        header("Location: historico.html?registro=sucesso");
        exit;
    } catch (PDOException $e) {
        die("Erro ao registrar refeição: " . $e->getMessage());
    }
}
?>