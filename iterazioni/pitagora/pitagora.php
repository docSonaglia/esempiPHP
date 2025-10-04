<?php
// Genera la tabella pitagorica fino a 10
$max = 10;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tabella Pitagorica fino a <?= $max ?></title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <div class="card">
        <h1>Tabella Pitagorica fino a <?= $max ?></h1>
    <table>
        <thead>
            <tr>
                <th class="header">×</th>
<?php for ($c = 1; $c <= $max; $c++): ?>
                <th class="header"><?= $c ?></th>
<?php endfor; ?>
            </tr>
        </thead>
        <tbody>
<?php for ($r = 1; $r <= $max; $r++): ?>
            <tr>
                <th class="header"><?= $r ?></th>
<?php for ($c = 1; $c <= $max; $c++): ?>
                <td><?= $r * $c ?></td>
<?php endfor; ?>
            </tr>
<?php endfor; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
