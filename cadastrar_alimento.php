<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['tutor_id'])) {
    header("Location: Login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTutor     = $_SESSION['tutor_id'];
    $nome        = trim($_POST['nome'] ?? '');
    $categoria   = trim($_POST['categoria'] ?? '');
    $textura     = $_POST['textura'] ?? '';
    $cor         = trim($_POST['cor'] ?? '');
    $aroma       = $_POST['aroma'] ?? '';
    $temperatura = $_POST['temperatura'] ?? '';
    $sabor       = $_POST['sabor'] ?? '';

    $kcal        = (float)($_POST['kcal'] ?? 0);
    $proteinas   = (float)($_POST['proteinas'] ?? 0);
    $carboidrato = (float)($_POST['carboidrato'] ?? 0);
    $gordura     = (float)($_POST['gordura'] ?? 0);
    $fibra       = (float)($_POST['fibra'] ?? 0);

    $ferro       = (float)($_POST['ferro'] ?? 0);
    $vitaminaB12 = (float)($_POST['vitamina_b12'] ?? 0);
    $calcio      = (float)($_POST['calcio'] ?? 0);
    $zinco       = (float)($_POST['zinco'] ?? 0);

    try {
        $sql = "INSERT INTO ALIMENTO 
            (Id_Tutor, NOME, Categoria, Textura, Cor, Aroma, Temperatura, Sabor, kcal, proteinas, carboidrato, gordura, fibra, ferro, vitamina_b12, calcio, zinco) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $idTutor, $nome, $categoria, $textura, $cor, $aroma, $temperatura, $sabor,
            $kcal, $proteinas, $carboidrato, $gordura, $fibra, $ferro, $vitaminaB12, $calcio, $zinco
        ]);

        header("Location: principal.html?alimento=sucesso");
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar alimento: " . $e->getMessage());
    }
}
?>