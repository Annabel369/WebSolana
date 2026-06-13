<?php
// web_sol/lang_detector.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['lang'])) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    // Para testes locais, o IP-API não funciona com 127.0.0.1
    if ($user_ip == '127.0.0.1' || $user_ip == '::1') {
        $user_ip = ''; // O IP-API usará o IP público do servidor se estiver vazio
    }

    $api_url = "http://ip-api.com/json/" . $user_ip . "?fields=status,countryCode";
    $response = @file_get_contents($api_url);
    $data = json_decode($response, true);

    if ($data && $data['status'] === 'success') {
        $country = $data['countryCode'];
        if (in_array($country, ['BR', 'PT'])) {
            $_SESSION['lang'] = 'pt';
        } elseif (in_array($country, ['ES', 'MX', 'AR', 'CL', 'CO', 'PE', 'VE', 'UY', 'PY', 'BO', 'EC', 'GT', 'HN', 'SV', 'NI', 'CR', 'PA', 'DO', 'PR'])) {
            $_SESSION['lang'] = 'es';
        } else {
            $_SESSION['lang'] = 'en';
        }
    } else {
        $_SESSION['lang'] = 'en'; // Fallback padrão
    }
}

$current_lang = $_SESSION['lang'];
$lang_file = __DIR__ . "/languages/" . $current_lang . ".php";

if (file_exists($lang_file)) {
    include $lang_file;
} else {
    include __DIR__ . "/languages/en.php";
}
