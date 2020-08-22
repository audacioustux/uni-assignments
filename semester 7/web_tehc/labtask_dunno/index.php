<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = "root";
    $pass = "password";
    $name = "lab_task";
    $host = "127.0.0.1";

    $dsn = 'mysql:host=' . $host . ';dbname=' . $name;
    $conn;
    try {
        $conn = new PDO($dsn, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'db connection err: ' . $e->getMessage();
    }

    $query = "INSERT INTO orders (price) values (?)";
    $conn = $stmt = $conn->prepare($query);
    $stmt->execute([$_POST['price']]);

    $_POST = array();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabTask -- registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
            <div class="notification is-success">
                <button class="delete"></button>
                Order Submitted
            </div>
        <?php endif; ?>
        <form method="POST">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Ammount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Liverpool 2020/ 21 Home Kit</td>
                        <td>2500 ৳</td>
                        <td><input class="ammount" type="number" min=0 max=4 value="0" /></td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Real Madrid 2020/ 21 Away Kit</td>
                        <td>1000 ৳</td>
                        <td><input class="ammount" type="number" min=0 max=4 value="0" /></td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Bayern Munich 2020/ 21 Third kit</td>
                        <td>1500 ৳</td>
                        <td><input class="ammount" type="number" min=0 max=4 value="0" /></td>
                    </tr>
                </tbody>
            </table>
            <div class="field is-grouped is-grouped-centered">
                <p class="control">
                    <button type="button" class="button is-light" onclick="calculate()">
                        Calculate
                    </button>
                </p>
                <p class="control">
                    <button type="submit" class="button is-primary">
                        Order
                    </button>
                </p>
            </div>
            <input name="price" id="price" value="0" hidden>
        </form>
    </div>
    <script type="text/javascript">
        function calculate() {
            const amms = document.getElementsByClassName('ammount');
            let total = 0;
            const prices = [2500, 1000, 1500];
            for (i = 0; i < amms.length; i++) {
                const amm = parseInt(amms[i].value);
                if (amm != 0) {
                    const price = prices[i];

                    if (amm == 4) {
                        console.log(typeof(price))
                        total += ((price / 100) * 20) * amm;
                    } else {
                        total += price * amm;
                    }
                }
            }
            document.getElementById('price').value = total;
        }
    </script>
</body>

</html>