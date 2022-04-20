<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $_POST["name"];
    $_POST["day"];
    $_POST["month"];
    $_POST["year"];
    $_POST["hour"];
    $_POST["minute"];
    $_POST["second"];

    function isLeapYear($year)
    {
        if ($year % 400 == 0) {
            return true;
        } else if ($year % 100 == 0) {
            return false;
        } else if ($year % 4 == 0) {
            return true;
        } else return false;
    }
    function caculateDay($month, $year)
    {
        switch ($month) {
            case "January":
            case "March":
            case "May":
            case "July":
            case "August":
            case "October":
            case "December":
                return "31";
                break;
            case "April":
            case "June":
            case "September":
            case "November":
                return "30";
                break;
            case "February":
                if (isLeapYear($year))  return "29";
                else  return "28";
                break;
        }
    }
    $_SESSION["caculateDay"] = caculateDay($_POST["month"], $_POST["year"]);

    ?>
    <p> Hi <?php echo $_POST["name"] ?>!</p>
    <p>You have choose to have an appointment on
        <?php print $_POST["hour"] . ":" . $_POST["minute"] . ":" . $_POST["second"] . ", " . $_POST["day"] . "/" . $_POST["month"] . "/" . $_POST["year"]; ?>
    </p>
    <p>More infomation</p>
    <p>In 12 hours, the time and date is
        <?php
        if ($_POST["hour"] < 12) {
            print $_POST["hour"] . ":" . $_POST["minute"] . ":" . $_POST["second"] . " AM" . ", " . $_POST["day"] . "/" . $_POST["month"] . "/" . $_POST["year"];
        } else {
            print ($_POST["hour"] - 12) . ":" . $_POST["minute"] . ":" . $_POST["second"] . " PM" . ", " . $_POST["day"] . "/" . $_POST["month"] . "/" . $_POST["year"];
        }
        ?>
    </p>
    <p>This month has <?php echo $_SESSION["caculateDay"] ?> days</p>
</body>

</html>