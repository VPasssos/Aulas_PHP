
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sanitização básica (remove tags e espaços extras)
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return trim(filter_var($data, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
}

// Escape para saída em HTML
function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

// CSRF
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_field() {
    $t = e(csrf_token());
    echo '<input type="hidden" name="csrf_token" value="'.$t.'">';
}
function verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(400);
            die('CSRF token inválido.');
        }
    }
}

// Login helpers
function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: login.php?erro=nao_autorizado');
        exit;
    }
}

function is_admin() {
    return isset($_SESSION['user']['permissao']) && $_SESSION['user']['permissao'] === 'admin';
}
