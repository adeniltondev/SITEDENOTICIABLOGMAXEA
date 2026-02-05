<?php
function start_session_if_needed(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

define('DATA_FILE', __DIR__ . '/../data/news.json');
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123');
define('BASE_PATH', '');

function base_url(string $path = ''): string {
    $base = rtrim(BASE_PATH, '/');
    $path = '/' . ltrim($path, '/');
    return $base . $path;
}

function readNews(): array {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $json = file_get_contents(DATA_FILE);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function saveNews(array $items): void {
    $json = json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(DATA_FILE, $json);
}

function getNewsById(array $items, string $id): ?array {
    foreach ($items as $item) {
        if ($item['id'] === $id) {
            return $item;
        }
    }
    return null;
}

function getLatest(array $items, int $limit = 6): array {
    usort($items, function ($a, $b) {
        return strtotime($b['published_at']) <=> strtotime($a['published_at']);
    });
    return array_slice($items, 0, $limit);
}

function getFeatured(array $items): ?array {
    foreach ($items as $item) {
        if (!empty($item['is_featured'])) {
            return $item;
        }
    }
    return $items[0] ?? null;
}

function getLive(array $items): ?array {
    foreach ($items as $item) {
        if (!empty($item['is_live'])) {
            return $item;
        }
    }
    return null;
}

function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text ?: 'n-a');
}

function isAdmin(): bool {
    start_session_if_needed();
    return !empty($_SESSION['admin_logged_in']);
}

function requireAdmin(): void {
    if (!isAdmin()) {
        header('Location: ' . base_url('admin/login.php'));
        exit;
    }
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
