<?php
include 'includes/auth.php';
checkAuth();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Bem-vindo ao Painel de Controle</h2>
        <ul>
            <li><a href="cadastro_paciente.php">Cadastrar Paciente</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
            <li><a href="prontuario.php">Prontuário</a></li>
        </ul>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>