<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Index</title>
</head>

<body>
    <form action="submit.php" method="post">
        <label for="quantity">Sunaudota kWh per mėnesį:</label><br>
        <input type="number" step="0.01" id="quantity" name="quantity" placeholder="Sunaudota kWh" required><br>
        <label for="price_rate">Kaina už vieną kWh, €:</label><br>
        <input type="number" step="0.01" id="price_rate" name="price_rate" placeholder="Kaina už veiną kWh, €" required><br>
        <label for="rate">Tarifas:</label><br>
        <select name="rate" id="rate" required>
            <option value="day">Dieninis</option>
            <option value="night">Naktinis</option>
        </select><br>
        <label for="month">Apmokamas mėnuo:</label><br>
        <input type="month" id="month" name="month" required><br>
        <input type="submit" value="Skaičiuoti kainą">
    </form>
<?php if(isset($_POST['message'])): ?>
<h1> <?=$_POST['message']?> </h1>
<?php endif ?>
</body>
</html>