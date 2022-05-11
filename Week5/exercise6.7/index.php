<html>

<head>
    <title>Table Output</title>
    <style>
    </style>
</head>

<body><?php
        require '../config.php';
        mysqli_select_db($connect, $mydb);
        print '<font size="5" color="blue">';
        print "Business Listings</font><br>";
        $query = "SELECT CatID, Title FROM categories";

        $results_id = mysqli_query($connect, $query);
        ?>
    <form action="" method="post">
        <table style="width:100%">
            <th style="width:30%"></th>
            <th></th>
            <tr>
                <td>
                    <table style="width:100%" border=1>
                        <th>Click on a category to find business listings:</th>
                        <?php

                        if ($results_id) {
                            while ($row = $results_id->fetch_assoc()) {
                                print '<tr><td><a href="index.php?act=' . $row['CatID'] . '">' . $row['Title'] . '</a></td></tr>';
                            }
                        } else {
                            die("Query=$query failed!");
                        }
                        ?>
                    </table>
                </td>
                <td>
                    <table style="width:100%" border=1>
                        <?php
                        if (isset($_GET['act'])) {
                            $queryBusiness = "SELECT b.ID, b.Name, b.Address, b.City, b.Telephone, b.URL, bc.BusinessID, bc.CategoryID "
                                . "FROM businesses as b "
                                . "INNER JOIN biz_categories as bc ON bc.BusinessID = b.ID "
                                . "INNER JOIN categories as c ON c.CatID = bc.CategoryID "
                                . "WHERE c.CatID LIKE '" . $_GET['act'] . "'";
                            $result = $connect->query($queryBusiness);
                            if ($result) {
                                while ($b = $result->fetch_assoc()) {
                                    print '<tr>';
                                    foreach ($b as $field) {
                                        print '<td>' . $field . '</td>';
                                    }
                                    print '</tr>';
                                }
                            } else {
                                die("Query=$queryBusiness failed!");
                            }
                            mysqli_close($connect);
                        }
                        ?>
                    </table>
                </td>
            </tr>
        </table>

    </form>
</body>

</html>