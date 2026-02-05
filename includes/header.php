<?php if (!isset($pageTitle)) { $pageTitle = 'Portal de Notícias'; } ?>
<?php $homeUrl = base_url(''); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/style.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>
<header class="topbar">
    <div class="container topbar__content">
        <div class="brand">
            <span class="brand__logo">BM</span>
            <div class="brand__text">
                <h1>Blog do Max</h1>
                <small>Portal de notícias em tempo real</small>
            </div>
        </div>
        <div class="topbar__widgets">
            <div class="widget widget--time">
                <span id="time-now">--:--</span>
                <small id="date-now">--</small>
            </div>
            <div class="widget widget--weather">
                <span id="weather-temp">--°C</span>
                <small id="weather-city">Tempo</small>
            </div>
            <a class="btn btn--ghost" href="<?php echo e(base_url('admin/login.php')); ?>">Painel</a>
        </div>
    </div>
</header>

<nav class="nav">
    <div class="container nav__content">
        <a href="<?php echo e($homeUrl); ?>" class="nav__link">Início</a>
        <a href="<?php echo e($homeUrl); ?>#ultima-hora" class="nav__link">Última Hora</a>
        <a href="<?php echo e($homeUrl); ?>#ao-vivo" class="nav__link">Ao Vivo</a>
        <a href="<?php echo e($homeUrl); ?>#categorias" class="nav__link">Categorias</a>
        <a href="<?php echo e($homeUrl); ?>#contato" class="nav__link">Contato</a>
        <span class="nav__badge">24/7</span>
    </div>
</nav>
