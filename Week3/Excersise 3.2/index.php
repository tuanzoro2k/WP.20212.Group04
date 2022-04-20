<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        Enter Degree: <input type="number" name="degree" value="<?php isset($_POST['degree']) ? print $_POST['degree'] : "" ?>">
        <br><br>
        <input type="submit" name="submit" value="Convert">
        <input type="reset" name="reset" value="Clear and Restart">
        <button><a href="index2.php">Swap</a></button>
        <br><br>
    </form>
    <?php
    const PI = 3.14159;
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['degree'])) {
        echo "Result: " . round(convertToRadian($_POST["degree"]), 2);
    }
    function convertToRadian($degree)
    {
        return ($degree * (PI / 180));
    }
    ?>
</body>

</html>