<?php
require __DIR__ . '/includes/functions.php';
$news = readNews();
$featured = getFeatured($news);
$latest = getLatest($news, 8);
$live = getLive($news);
$pageTitle = 'Início · Blog do Max';
include __DIR__ . '/includes/header.php';
?>

<section class="breaking">
    <div class="container breaking__content">
        <span class="breaking__label">Última Hora</span>
        <div class="breaking__ticker" id="breaking-ticker">
            <?php foreach ($latest as $item): ?>
                <span><?php echo e($item['title']); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<main class="container">
    <section class="hero">
        <?php if ($featured): ?>
            <article class="hero__main">
                <img src="<?php echo e($featured['image']); ?>" alt="<?php echo e($featured['title']); ?>" />
                <div class="hero__content">
                    <span class="tag"><?php echo e($featured['category']); ?></span>
                    <h2><?php echo e($featured['title']); ?></h2>
                    <p><?php echo e($featured['excerpt']); ?></p>
                    <div class="hero__meta">
                        <span><?php echo date('d/m/Y H:i', strtotime($featured['published_at'])); ?></span>
                        <a class="btn" href="/noticia.php?id=<?php echo e($featured['id']); ?>">Ler agora</a>
                    </div>
                </div>
            </article>
        <?php endif; ?>
        <aside class="hero__side">
            <div class="card">
                <h3>Newsletter</h3>
                <p>Receba as principais notícias no seu e-mail.</p>
                <form class="form">
                    <input type="email" placeholder="seuemail@exemplo.com" />
                    <button type="button" class="btn btn--accent">Assinar</button>
                </form>
            </div>
            <div class="card">
                <h3>Radar do Dia</h3>
                <ul class="list">
                    <li>Economia em foco</li>
                    <li>Política regional</li>
                    <li>Cultura & Eventos</li>
                    <li>Esporte local</li>
                </ul>
            </div>
        </aside>
    </section>

    <section class="grid" id="ultima-hora">
        <div class="section__header">
            <h2>Notícias Recentes</h2>
            <a class="link" href="#">Ver tudo</a>
        </div>
        <div class="grid__cards">
            <?php foreach ($latest as $item): ?>
                <article class="card news-card">
                    <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" />
                    <div class="news-card__body">
                        <span class="tag tag--small"><?php echo e($item['category']); ?></span>
                        <h3><?php echo e($item['title']); ?></h3>
                        <p><?php echo e($item['excerpt']); ?></p>
                        <div class="news-card__footer">
                            <span><?php echo date('d/m/Y H:i', strtotime($item['published_at'])); ?></span>
                            <a class="link" href="/noticia.php?id=<?php echo e($item['id']); ?>">Ler</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="live" id="ao-vivo">
        <div class="section__header">
            <h2>Notícia ao Vivo</h2>
        </div>
        <?php if ($live): ?>
            <article class="live__card">
                <div>
                    <span class="tag tag--live">Ao Vivo</span>
                    <h3><?php echo e($live['title']); ?></h3>
                    <p><?php echo e($live['content']); ?></p>
                    <a class="btn btn--ghost" href="/noticia.php?id=<?php echo e($live['id']); ?>">Acompanhar</a>
                </div>
                <div class="live__meta">
                    <p>Atualizado em</p>
                    <strong><?php echo date('d/m/Y H:i', strtotime($live['published_at'])); ?></strong>
                </div>
            </article>
        <?php else: ?>
            <div class="card">Sem notícias ao vivo no momento.</div>
        <?php endif; ?>
    </section>

    <section class="categories" id="categorias">
        <div class="section__header">
            <h2>Categorias</h2>
        </div>
        <div class="categories__grid">
            <div class="category-card">Política</div>
            <div class="category-card">Economia</div>
            <div class="category-card">Cidades</div>
            <div class="category-card">Esportes</div>
            <div class="category-card">Cultura</div>
            <div class="category-card">Tecnologia</div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
