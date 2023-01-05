<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ataskaita</title>
</head>
<style>
    body {
        font-family: "Segoe UI", Tahoma, Verdana, sans-serif ;
    }
    table, th,td,tr {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0.75rem;
        margin: 0.5rem;
        text-align: center;
    }
    label, input, select, option, h3 {
        margin: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.25rem;
    }
    a, a:active, a:visited {
        color: white;
        text-decoration: none;
        margin: 0.5rem;
        padding: 0.25rem;
        background-color: #1e425d;
        border-radius: 0.25rem;
    }
    a:hover {
        background-color: #2a5d84;
    }

    form input[type=submit]:hover {
        background-color: #aaaaaa;
    }
</style>
<body>
<a href="<?= $_SERVER['REQUEST_URI'] . '/../'?>">Grįžti į pradinį</a>
<?php if(isset($message)): ?>
<h3><?=$message?></h3>
<?php endif; ?>
<?php if(isset($payments)): ?>
<table>
    <tbody>
    <tr>
        <th>Mėnuo</th>
        <th>Suvartota, kWh</th>
        <th>Mokėjimo tarifas, €</th>
        <th>Tarifas</th>
        <th>Suma</th>
        <th>Statusas</th>
    </tr>
    <?php if(isset($payments)): ?>
    <?php foreach ($payments as $i => $payment): ?>
    <tr>
        <td><?= $payment->getMonth() ?></td>
        <td><?= $payment->getQuantity() ?></td>
        <td><?= $payment->getPriceRate() ?></td>
        <td><?= $payment->getRate() ?></td>
        <td><?= $payment->getSum() ?></td>
        <td><?= $payment->getStatus() ?></td>
        <?php $total += $payment->getSum() ?>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<h3>Viso neapmokėta suma: <?= round($total,2);?>€</h3>
<form action="pay.money" method="post">
    <input type="submit" value="Deklaruoti ir apmokėti">
</form>
<?php endif; ?>
</body>
</html>