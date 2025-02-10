<?php
include 'includes/auth.php';
checkAuth();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $stmt = $conn->prepare("INSERT INTO consultas (paciente_id, data, hora) VALUES (?, ?, ?)");
    $stmt->execute([$paciente_id, $data, $hora]);

    echo "<div class='alert alert-success'>Consulta agendada com sucesso!</div>";
}

// Busca pacientes para o select
$pacientes = $conn->query("SELECT id, nome FROM pacientes")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Agendar Consulta</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
                <select class="form-control" id="paciente_id" name="paciente_id" required>
                    <?php foreach ($pacientes as $paciente): ?>
                        <option value="<?php echo $paciente['id']; ?>"><?php echo $paciente['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>