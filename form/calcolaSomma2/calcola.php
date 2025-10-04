<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stile.css">
    <title>Calcola Somma</title>
    <style>
        /* Piccolo aggiustamento inline per il layout quando necessario: non tocca il file stile.css */
        #container-calcolo { max-width:520px; margin:28px auto; padding:18px; }
    </style>
</head>
<body>
<?php
// File autosufficiente: mostra il form e, dopo submit, mostra il risultato.
$error = '';
$result = null;
$num1_val = '';
$num2_val = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prendo i valori raw per poterli ripopolare nel form
    $num1_val = isset($_POST['num1']) ? trim($_POST['num1']) : '';
    $num2_val = isset($_POST['num2']) ? trim($_POST['num2']) : '';

    // Uso filter_var per validare i numeri (accetta anche numeri con virgola)
    $n1 = filter_var(str_replace(',', '.', $num1_val), FILTER_VALIDATE_FLOAT);
    $n2 = filter_var(str_replace(',', '.', $num2_val), FILTER_VALIDATE_FLOAT);

    if ($n1 === false || $num1_val === '') {
        $error = 'Valore A non valido. Inserisci un numero.';
    } elseif ($n2 === false || $num2_val === '') {
        $error = 'Valore B non valido. Inserisci un numero.';
    } else {
        $sum = $n1 + $n2;
        if (floor($sum) == $sum) {
            $result = number_format($sum, 0, '.', '');
        } else {
            $result = rtrim(rtrim(number_format($sum, 6, '.', ''), '0'), '.');
        }
    }
}
?>

    <div id="container-calcolo">
        <h1>Calcola Somma</h1>

        <?php if ($error): ?>
            <div class="error" role="alert"><?=htmlspecialchars($error)?></div>
        <?php endif; ?>

        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" novalidate>
            <div class="field">
                <label for="num1">Numero A</label>
                <input type="number" id="num1" name="num1" value="<?=htmlspecialchars($num1_val)?>" inputmode="decimal" required>
            </div>

            <div class="field">
                <label for="num2">Numero B</label>
                <input type="number" id="num2" name="num2" value="<?=htmlspecialchars($num2_val)?>" inputmode="decimal" required>
            </div>

            <div class="actions">
                <button type="submit">Calcola</button>
            </div>
        </form>

        <?php if ($result !== null && $error === ''): ?>
            <div class="result" role="status" style="margin-top:16px;">
                <strong>Somma:</strong> <?=htmlspecialchars($result)?>
            </div>
        <?php endif; ?>

        <p style="margin-top:14px;">
            <a href="../calcolaSomma/calcola.html" style="color:var(--accent); text-decoration:none; font-weight:600;">&larr; Apri la versione HTML</a>
        </p>
    </div>

</body>
</html>