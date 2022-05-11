<html>

<head>
    <title>Categories</title>
</head>

<body>
    <?php
    require '../config.php';
    $table_name = 'categories';
    if (!$connect) {
        die("Cannot connect to $server using $user");
    }
    mysqli_select_db($connect, $mydb);
    if (isset($_POST["CatID"]) && isset($_POST["Title"]) && isset($_POST["Desc"])) {
        $categoryID = $_POST["CatID"];
        $title = $_POST["Title"];
        $description = $_POST["Desc"];
        $insertquery =  "Insert into $table_name value('$categoryID','$title', '$description');";
        $connect->query($insertquery);
    }
    print '<font size="5" color="blue">';
    print "Category Administration</font><br>";
    $query = "SELECT * FROM $table_name";

    $results_id = mysqli_query($connect, $query);
    if ($results_id) {
        print '<form action="" method="post">';
        print '<table border=1 style="width:100%">';
        print '<th style="width:20%; background-color: #eee">CatID
        <th style ="background-color: #eee">Title
        <th style ="background-color: #eee">Description';
        while ($row = mysqli_fetch_row($results_id)) {
            print '<tr>';
            foreach ($row as $field) {
                print "<td>$field</td> ";
            }
            print '</tr>';
        }
        print '<tr>';
        print '<td><input type="text" style="width:100%" name="CatID"></td>';
        print '<td><input type="text" style="width:100%" name="Title"></td>';
        print '<td><input type="text" style="width:100%" name="Desc"></td>';
        print '</tr>';
        print '</table>';
        print '<input type="submit" value="Add Category">';
        print '</form>';
    } else {
        die("Query=$query failed!");
    }
    mysqli_close($connect);
    ?>
</body>

</html>