<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stile.css">
    <title>Risultato Calcolo</title>
</head>
<body>
<?php
// Legge i valori inviati via POST e calcola la somma
$error = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Uso filter_input per sicurezza e validazione di base
    $n1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    $n2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);

    if ($n1 === null || $n1 === false) {
        $error = 'Valore A non valido. Inserisci un numero.';
    } elseif ($n2 === null || $n2 === false) {
        $error = 'Valore B non valido. Inserisci un numero.';
    } else {
        // Calcolo la somma con precisione ragionevole
        $sum = $n1 + $n2;
        // Formatto il risultato mostrando massimo 2 decimali quando necessario
        if (floor($sum) == $sum) {
            $result = number_format($sum, 0, '.', '');
        } else {
            $result = rtrim(rtrim(number_format($sum, 6, '.', ''), '0'), '.');
        }
    }
} else {
    $error = 'Nessun dato ricevuto. Usa il form per inviare due numeri.';
}
?>

    <div id="container-calcolo">
        <h1>Risultato Somma</h1>

        <?php if ($error): ?>
            <div class="error" role="alert"><?=htmlspecialchars($error)?></div>
        <?php else: ?>
            <div class="result" role="status">
                <strong>Somma:</strong> <?=htmlspecialchars($result)?>
            </div>
        <?php endif; ?>

        <p style="margin-top:14px;">
            <a href="calcola.html" style="color:var(--accent); text-decoration:none; font-weight:600;">&larr; Torna al form</a>
        </p>
    </div>

</body>
</html>