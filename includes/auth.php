<?php
session_start();

// Verifica se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redireciona para a página de login se não estiver logado
function checkAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
?>