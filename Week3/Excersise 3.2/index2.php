<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index2.php" method="post">
        Enter Radian: <input type="number" name="radian" value="<?php isset($_POST['radian']) ? print $_POST['radian'] : "" ?>">
        <br><br>
        <input type="submit" name="submit" value="Convert">
        <input type="reset" name="reset" value="Clear and Restart">
        <button><a href="index.php">Swap</a></button>
        <br><br>
    </form>
    <?php
    const PI = 3.14159;
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['radian'])) {
        echo "Result: " . round(convertToDegree($_POST["radian"]), 2);
    }
    function convertToDegree($radian)
    {
        return ($radian * (180 / PI));
    }
    ?>
</body>

</html>