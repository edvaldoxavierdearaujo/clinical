<?php
include 'includes/auth.php';
checkAuth();
include 'includes/db.php';

// Verifica se o ID do paciente foi passado
if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$paciente_id = $_GET['id'];

// Busca informações do paciente
$stmt = $conn->prepare("SELECT nome FROM pacientes WHERE id = ?");
$stmt->execute([$paciente_id]);
$paciente = $stmt->fetch();

if (!$paciente) {
    echo "<div class='alert alert-danger'>Paciente não encontrado.</div>";
    exit();
}

// Adiciona uma nova anotação ao prontuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $anotacao = $_POST['anotacao'];

    $stmt = $conn->prepare("INSERT INTO prontuario (paciente_id, anotacao) VALUES (?, ?)");
    $stmt->execute([$paciente_id, $anotacao]);

    echo "<div class='alert alert-success'>Anotação adicionada com sucesso!</div>";
}

// Busca todas as anotações do prontuário
$stmt = $conn->prepare("SELECT * FROM prontuario WHERE paciente_id = ? ORDER BY data DESC");
$stmt->execute([$paciente_id]);
$anotacoes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prontuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Prontuário de <?php echo $paciente['nome']; ?></h2>

        <!-- Formulário para adicionar anotação -->
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="anotacao" class="form-label">Nova Anotação</label>
                <textarea class="form-control" id="anotacao" name="anotacao" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>

        <!-- Lista de anotações -->
        <h3>Anotações</h3>
        <?php if (count($anotacoes) > 0): ?>
            <ul class="list-group">
                <?php foreach ($anotacoes as $anotacao): ?>
                    <li class="list-group-item">
                        <p><?php echo $anotacao['anotacao']; ?></p>
                        <small class="text-muted">Data: <?php echo $anotacao['data']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma anotação encontrada.</p>
        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>