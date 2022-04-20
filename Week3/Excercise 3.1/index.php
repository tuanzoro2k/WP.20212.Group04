<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="form.php" method="post">
        <label for="name">Your name:</label>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="date">Date:</label>
        <?php
        echo "<select name=day>";
        for ($i = 1; $i <= 31; $i++) {
            echo "<option name='$i'>$i</option>";
        }
        echo "</select>";
        echo "<select name=month>";
        for ($i = 0; $i <= 11; $i++) {
            $month = date('F', strtotime("first day of -$i month"));
            echo "<option value=$month>$month</option> ";
        }
        echo "</select>";
        echo "<select name=year>";
        for ($i = 0; $i <= 10; $i++) {
            $year = date('Y', strtotime("last day of +$i year"));
            echo "<option name='$year'>$year</option>";
        }
        echo "</select>";
        ?>
        <br><br>
        <label for="time">Time:</label>
        <?php
        echo "<select name=hour>";
        for ($i = 0; $i <= 23; $i++) {

            // $hour = date('h', strtotime("+$i hour"));
            echo "<option name='$i'>$i</option>";
        }
        echo "</select>";
        echo "<select name=minute>";
        for ($i = 0; $i <= 23; $i++) {
            echo "<option name='$i'>$i</option>";
        }
        echo "</select>";
        echo "<select name=second>";
        for ($i = 0; $i <= 60; $i++) {
            echo "<option name='$i'>$i</option>";
        }
        echo "</select>";
        ?>
        <br><br>
        <input type="submit" name="submit" value="Click to submit">
        <input type="reset" name="reset" value="Clear and Restart">
    </form>
</body>

</html>