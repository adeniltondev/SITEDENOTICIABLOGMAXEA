<?php
require __DIR__ . '/../includes/functions.php';
start_session_if_needed();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/dashboard.php');
        exit;
    }
    $error = 'Usuário ou senha inválidos.';
}
$pageTitle = 'Login · Painel';
include __DIR__ . '/../includes/header.php';
?>

<main class="container admin">
    <div class="card admin__card">
        <h2>Painel Administrativo</h2>
        <p>Acesse para gerenciar notícias.</p>
        <?php if ($error): ?>
            <div class="alert alert--error"><?php echo e($error); ?></div>
        <?php endif; ?>
        <form class="form" method="post">
            <label>Usuário</label>
            <input type="text" name="user" required />
            <label>Senha</label>
            <input type="password" name="pass" required />
            <button class="btn" type="submit">Entrar</button>
        </form>
        <small class="muted">Troque a senha em includes/functions.php</small>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
