<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="DateTimeFunction.php" method="post">
        <label for="name1">First person's name:</label>
        <input type="text" id="name1" name="name1">
        <input type="date" id="birthday1" name="birthday1">
        <br><br>

        <label for="name2">Second person's name:</label>
        <input type="text" id="name2" name="name2">
        <input type="date" id="birthday2" name="birthday2">
        <br><br>
        <input type="submit" name="submit" value="Click to submit">
        <input type="reset" name="reset" value="Clear and Restart">
    </form>
    <?php

    if (isset($_POST["birthday1"]) && isset($_POST["birthday1"]) && isset($_POST["name1"]) && isset($_POST["name2"])) {
        $birthday1 = $_POST["birthday1"];
        $birthday2 = $_POST["birthday2"];
        echo $_POST["name1"] . " has birthday on " . date("l, F j Y", strtotime($birthday1));
        echo "<br><br>";
        echo $_POST["name2"] . " has birthday on " . date("l, F j Y", strtotime($birthday2));
        echo "<br><br>";
        $diff = strtotime($birthday1) - strtotime($birthday2);
        echo "The difference between 2 dates: " . abs(round($diff / 86400)) . " days";
        echo "<br><br>";
        $age1 = strtotime("now") - strtotime($birthday1);
        echo $_POST["name1"] . " is " . abs(round($age1 / (86400 * 365))) . " years old.";
        echo "<br><br>";
        $age2 = strtotime("now") - strtotime($birthday2);
        echo $_POST["name2"] . " is " . abs(round($age2 / (86400 * 365))) . " years old.";
        echo "<br><br>";
        echo "The difference years between 2 person: " . abs(round($diff / (86400 * 365))) . " years";
    }

    ?>
</body>

</html>