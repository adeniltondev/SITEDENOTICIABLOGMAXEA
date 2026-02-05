<?php
require __DIR__ . '/../includes/functions.php';
requireAdmin();
$news = readNews();
$id = $_GET['id'] ?? '';
$item = $id ? getNewsById($news, $id) : null;
$pageTitle = $item ? 'Editar notícia' : 'Nova notícia';
include __DIR__ . '/../includes/header.php';
?>

<main class="container admin">
    <div class="card admin__card">
        <h2><?php echo e($pageTitle); ?></h2>
        <form class="form" method="post" action="<?php echo e(base_url('admin/save.php')); ?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="id" value="<?php echo e($item['id'] ?? ''); ?>" />

            <label>Título</label>
            <input type="text" name="title" value="<?php echo e($item['title'] ?? ''); ?>" required />

            <label>Categoria</label>
            <input type="text" name="category" value="<?php echo e($item['category'] ?? ''); ?>" required />

            <label>Imagem (URL)</label>
            <input type="text" name="image" value="<?php echo e($item['image'] ?? ''); ?>" required />

            <label>Resumo</label>
            <textarea name="excerpt" rows="3" required><?php echo e($item['excerpt'] ?? ''); ?></textarea>

            <label>Conteúdo</label>
            <textarea name="content" rows="8" required><?php echo e($item['content'] ?? ''); ?></textarea>

            <div class="form__row">
                <label><input type="checkbox" name="is_featured" <?php echo !empty($item['is_featured']) ? 'checked' : ''; ?> /> Destaque</label>
                <label><input type="checkbox" name="is_live" <?php echo !empty($item['is_live']) ? 'checked' : ''; ?> /> Ao vivo</label>
            </div>

            <button class="btn" type="submit">Salvar</button>
            <a class="btn btn--ghost" href="<?php echo e(base_url('admin/dashboard.php')); ?>">Voltar</a>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
