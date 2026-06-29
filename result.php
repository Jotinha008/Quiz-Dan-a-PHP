<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

$name = $_SESSION['name'];
$score = $_SESSION['score'];


$file = "ranking.txt";
$data = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];


$data[] = "$name|$score";


usort($data, function($a, $b) {
    $scoreA = (int) explode('|', $a)[1];
    $scoreB = (int) explode('|', $b)[1];
    return $scoreB - $scoreA;
});


$data = array_slice($data, 0, 50);

file_put_contents($file, implode(PHP_EOL, $data));

session_destroy();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <div class="card p-5 shadow-lg text-center">
        <h1 class="text-success mb-4">🎉 Parabéns!</h1>
        <h2><?= htmlspecialchars($name) ?></h2>
        <h3 class="mt-3">Você acertou <strong class="text-warning"><?= $score ?>/10</strong></h3>
        
        <div class="mt-4">
            <a href="ranking.php" class="btn btn-primary btn-lg me-2">Ver Ranking</a>
            <a href="index.php" class="btn btn-outline-light btn-lg">Jogar Novamente</a>
        </div>
    </div>
</div>
</body>
</html>