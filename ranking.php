<?php
$file = "ranking.txt";
$data = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Ranking - Quiz de Dança</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h1 class="text-center mb-4">🏆 Top 10 Ranking</h1>
        
        <?php if (empty($data)): ?>
            <p class="text-center text-muted">Nenhum jogador ainda. Seja o primeiro!</p>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Posição</th>
                        <th>Nome</th>
                        <th>Pontuação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 1;
                    foreach (array_slice($data, 0, 10) as $player): 
                        $parts = explode("|", $player, 2);
                        $name = $parts[0] ?? 'Anônimo';
                        $score = $parts[1] ?? 0;
                    ?>
                    <tr>
                        <td><strong>#<?= $count++ ?></strong></td>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td><strong><?= $score ?>/10</strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-success btn-lg">Jogar Novamente</a>
        </div>
    </div>
</div>
</body>
</html>