<?php
require __DIR__ . '/includes/functions.php';
$news = readNews();
$id = $_GET['id'] ?? '';
$item = getNewsById($news, $id);
$pageTitle = $item ? $item['title'] . ' · Blog do Max' : 'Notícia não encontrada';
include __DIR__ . '/includes/header.php';
?>

<main class="container article">
    <?php if ($item): ?>
        <article>
            <div class="article__header">
                <span class="tag"><?php echo e($item['category']); ?></span>
                <h2><?php echo e($item['title']); ?></h2>
                <p class="article__meta"><?php echo date('d/m/Y H:i', strtotime($item['published_at'])); ?></p>
            </div>
            <img class="article__image" src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" />
            <div class="article__content">
                <p><?php echo nl2br(e($item['content'])); ?></p>
            </div>
            <div class="article__footer">
                <a class="btn btn--ghost" href="/">Voltar</a>
            </div>
        </article>
    <?php else: ?>
        <div class="card">Notícia não encontrada.</div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
