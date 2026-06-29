<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $_SESSION['name'] = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $_SESSION['score'] = 0;
        $_SESSION['question'] = 0;
        $_SESSION['last_token'] = bin2hex(random_bytes(16)); // Proteção contra refresh
        header("Location: quiz.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Quiz de Dança</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h1 class="text-center text-primary mb-4">🕺 Quiz de Dança</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Digite seu nome:</label>
                <input type="text" name="name" class="form-control" required maxlength="50">
            </div>
            <button type="submit" class="btn btn-primary w-100">Começar o Quiz</button>
        </form>
    </div>
</div>
</body>
</html>