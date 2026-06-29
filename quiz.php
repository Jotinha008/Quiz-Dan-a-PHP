<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

$questions = [
    [
        "question" => "Qual dança é originária da Argentina?",
        "options" => ["Samba", "Tango", "Forró", "Frevo"],
        "answer" => 1
    ],
    [
        "question" => "Qual dança é tradicional do Brasil?",
        "options" => ["Samba", "Hip Hop", "Flamenco", "Valsa"],
        "answer" => 0
    ],
    [
        "question" => "Qual dança surgiu nos EUA?",
        "options" => ["Hip Hop", "Samba", "Ballet", "Forró"],
        "answer" => 0
    ],
    [
        "question" => "Qual dança usa sapatilhas de ponta?",
        "options" => ["Jazz", "Ballet", "Salsa", "Forró"],
        "answer" => 1
    ],
    [
        "question" => "Qual dança é típica da Espanha?",
        "options" => ["Frevo", "Flamenco", "Tango", "Axé"],
        "answer" => 1
    ],
    [
        "question" => "O breakdance faz parte de qual estilo?",
        "options" => ["Hip Hop", "Sertanejo", "Ballet", "Samba"],
        "answer" => 0
    ],
    [
        "question" => "Qual dança é muito comum em festas juninas?",
        "options" => ["Quadrilha", "Valsa", "Jazz", "Tango"],
        "answer" => 0
    ],
    [
        "question" => "Qual dança é popular em Cuba?",
        "options" => ["Salsa", "Frevo", "Forró", "Ballet"],
        "answer" => 0
    ],
    [
        "question" => "Qual dança pernambucana usa sombrinhas?",
        "options" => ["Axé", "Frevo", "Samba", "Jazz"],
        "answer" => 1
    ],
    [
        "question" => "Qual dança é considerada clássica?",
        "options" => ["Hip Hop", "Ballet", "Forró", "Samba"],
        "answer" => 1
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['token']) && $_POST['token'] === $_SESSION['last_token']) {
        $answer = (int)$_POST['answer'];
        
        if ($answer == $questions[$_SESSION['question']]['answer']) {
            $_SESSION['score']++;
        }
        
        $_SESSION['question']++;
        $_SESSION['last_token'] = bin2hex(random_bytes(16)); // Novo token para próxima pergunta
    }
}

if ($_SESSION['question'] >= count($questions)) {
    header("Location: result.php");
    exit();
}

$current = $questions[$_SESSION['question']];
$progress = $_SESSION['question'] + 1;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Quiz - Questão <?= $progress ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
<div class="container mt-5">
    <div class="card p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Questão <?= $progress ?> de <?= count($questions) ?></h5>
            <h5 class="text-primary">Pontos: <?= $_SESSION['score'] ?></h5>
        </div>
        
        <h4 class="mb-4"><?= htmlspecialchars($current['question']) ?></h4>
        
        <form method="POST">
            <input type="hidden" name="token" value="<?= $_SESSION['last_token'] ?>">
            
            <?php foreach ($current['options'] as $index => $option): ?>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="answer" value="<?= $index ?>" required>
                    <label class="form-check-label fs-5"><?= htmlspecialchars($option) ?></label>
                </div>
            <?php endforeach; ?>
            
            <button class="btn btn-success mt-4 w-100 py-3">Próxima Questão →</button>
        </form>
    </div>
</div>
</body>
</html>