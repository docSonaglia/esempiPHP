<?php
session_start();

// Verifica che l'utente sia autenticato
if (empty($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    http_response_code(403);
    echo "Accesso negato. Effettua il login prima di scaricare il file.";
    exit;
}

$file = __DIR__ . '/credentials.txt';
if (!is_file($file)) {
    http_response_code(404);
    echo "File non trovato.";
    exit;
}

// Imposta header per download come file di testo
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="credentials.txt"');
header('Content-Length: ' . filesize($file));

// Fornisce il file
readfile($file);
exit;
?>