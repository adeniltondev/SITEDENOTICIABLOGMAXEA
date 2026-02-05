<?php
require __DIR__ . '/../includes/functions.php';
requireAdmin();
$news = readNews();
$pageTitle = 'Dashboard · Painel';
include __DIR__ . '/../includes/header.php';
?>

<main class="container admin">
    <div class="admin__header">
        <h2>Gerenciar Notícias</h2>
        <div>
            <a class="btn" href="/admin/edit.php">Nova notícia</a>
            <a class="btn btn--ghost" href="/admin/logout.php">Sair</a>
        </div>
    </div>

    <div class="table">
        <div class="table__row table__head">
            <span>Título</span>
            <span>Categoria</span>
            <span>Data</span>
            <span>Ações</span>
        </div>
        <?php foreach ($news as $item): ?>
            <div class="table__row">
                <span><?php echo e($item['title']); ?></span>
                <span><?php echo e($item['category']); ?></span>
                <span><?php echo date('d/m/Y H:i', strtotime($item['published_at'])); ?></span>
                <span class="table__actions">
                    <a class="link" href="/admin/edit.php?id=<?php echo e($item['id']); ?>">Editar</a>
                    <form method="post" action="/admin/save.php" onsubmit="return confirm('Excluir esta notícia?');">
                        <input type="hidden" name="action" value="delete" />
                        <input type="hidden" name="id" value="<?php echo e($item['id']); ?>" />
                        <button class="link link--danger" type="submit">Excluir</button>
                    </form>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
