<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Elekros apskaitos sistema (EAS)</title>
</head>
<style>
    body {
        font-family: "Segoe UI", Tahoma, Verdana, sans-serif;
    }

    label, input, select, option, form {
        margin: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.25rem;
    }
    label {
        font-weight: bold;
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

    h3 {
        color: red;
    }

</style>

<body>
<a href="<?= $_SERVER['REQUEST_URI'] . '/../report' ?>">Ataskaita</a>
<form action="submit.form" method="post">
    <label for="quantity">Sunaudota kWh per mėnesį:</label><br>
    <input type="number" step="0.001" id="quantity" name="quantity" placeholder="Sunaudota kWh" required><br>
    <label for="price_rate">Kaina už vieną kWh, €:</label><br>
    <input type="number" step="0.001" id="price_rate" name="price_rate" placeholder="Kaina už vieną kWh, €"
           required><br>
    <label for="rate">Tarifas:</label><br>
    <select name="rate" id="rate" required>
        <option value="day">Dieninis</option>
        <option value="night">Naktinis</option>
    </select><br>
    <label for="month">Apmokamas mėnuo:</label><br>
    <input type="month" id="month" name="month" required><br>
    <input type="submit" value="Skaičiuoti kainą">
    <input type="text" name="status" value="NotPaid" hidden>
</form>
<?php if(isset($message)): ?>
<h3> <?=$message?> </h3>
<?php endif ?>
</body>
</html>