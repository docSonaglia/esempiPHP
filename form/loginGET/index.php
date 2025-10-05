<?php
session_start();

$message = null;
$messageClass = '';

// Funzione semplice per controllare le credenziali contro credentials.txt
function check_credentials($user, $pass) {
    $file = __DIR__ . '/credentials.txt';
    if (!is_file($file)) return false;
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue; // salta commenti
        $parts = explode(':', $line, 2);
        if (count($parts) !== 2) continue;
        list($u, $p) = $parts;
        if ($u === $user && $p === $pass) return true;
    }
    return false;
}

// Se sono passati username e password via GET, tentiamo il login
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = trim($_GET['username']);
    $password = trim($_GET['password']);

    if ($username === '' || $password === '') {
        $message = 'Compila username e password.';
        $messageClass = 'error';
        $_SESSION['authenticated'] = false;
    } else {
        if (check_credentials($username, $password)) {
            $_SESSION['authenticated'] = true;
            $_SESSION['user'] = $username;
            $message = 'Autenticazione avvenuta con successo. Benvenuto ' . htmlspecialchars($username) . '!';
            $messageClass = 'success';
        } else {
            $_SESSION['authenticated'] = false;
            $message = 'Credenziali non valide.';
            $messageClass = 'error';
        }
    }
}

?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login GET - Esempio didattico</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Login (metodo GET) - Esempio didattico</h1>
    <p class="note">Questo esempio invia username e password con il metodo GET. Non usarlo in produzione.</p>

    <?php if ($message): ?>
      <div class="message <?php echo $messageClass; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
      <p>Sei autenticato come <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>.</p>
      <a class="download-link" href="download.php">Scarica le credenziali (file di testo)</a>
    <?php else: ?>
      <form method="get" action="index.php" autocomplete="off">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <input type="submit" value="Accedi">
      </form>
    <?php endif; ?>

    <p class="note">Nota: Le credenziali sono memorizzate in chiaro nel file <code>credentials.txt</code> per scopi didattici.</p>
  </div>
</body>
</html>
