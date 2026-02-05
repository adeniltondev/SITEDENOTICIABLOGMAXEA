<?php
require __DIR__ . '/../includes/functions.php';
requireAdmin();

$news = readNews();
$action = $_POST['action'] ?? '';

if ($action === 'delete') {
    $id = $_POST['id'] ?? '';
    $news = array_values(array_filter($news, function ($item) use ($id) {
        return $item['id'] !== $id;
    }));
    saveNews($news);
    header('Location: /admin/dashboard.php');
    exit;
}

if ($action === 'save') {
    $id = $_POST['id'] ?? '';
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $isFeatured = isset($_POST['is_featured']);
    $isLive = isset($_POST['is_live']);

    $item = [
        'id' => $id ?: uniqid('news_', true),
        'title' => $title,
        'category' => $category,
        'image' => $image,
        'excerpt' => $excerpt,
        'content' => $content,
        'is_featured' => $isFeatured,
        'is_live' => $isLive,
        'published_at' => date('Y-m-d H:i:s'),
        'slug' => slugify($title)
    ];

    $found = false;
    foreach ($news as $index => $existing) {
        if ($existing['id'] === $item['id']) {
            $item['published_at'] = $existing['published_at'];
            $news[$index] = $item;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $news[] = $item;
    }

    if ($isFeatured) {
        foreach ($news as $i => $n) {
            if ($n['id'] !== $item['id']) {
                $news[$i]['is_featured'] = false;
            }
        }
    }

    if ($isLive) {
        foreach ($news as $i => $n) {
            if ($n['id'] !== $item['id']) {
                $news[$i]['is_live'] = false;
            }
        }
    }

    saveNews($news);
    header('Location: /admin/dashboard.php');
    exit;
}

header('Location: /admin/dashboard.php');
